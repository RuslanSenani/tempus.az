<?php

namespace App\Http\Middleware;

use App\Jobs\LogVisitJob;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;


class LogVisits
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */

    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();
        $userAgent = $request->userAgent();
        $agent = new Agent();

        // 1. Lokal IP və ya Ağ Siyahı (Whitelist)
        if (in_array($ip, ['127.0.0.1', '192.168.1.1', '::1'])) {
            return $next($request);
        }

        // 2. KRİTİK: Zərərli User-Agent yoxlaması (Hələ Agent kitabxanasına çatmadan)
        $badAgents = ['WormGPT', 'Sqlmap', 'Nmap', 'AhrefsBot', 'MJ12bot', 'DotBot'];
        foreach ($badAgents as $bad) {
            if (str_contains($userAgent, $bad)) {
                abort(403, 'Giriş qadağandır.');
            }
        }

        // 3. Yaxşı Botlara (Google, Bing və s.) imtiyaz tanımaq
        $isBot = $agent->isRobot();
        $robotName = $agent->robot();
        $friendlyBots = ['Googlebot', 'Bingbot', 'YandexBot', 'DuckDuckBot'];

        $isFriendly = false;
        if ($isBot && in_array($robotName, $friendlyBots)) {
            $isFriendly = true;
        }

        // 4. Əgər bu yaxşı bot DEYİLSƏ, limitləri yoxla
        if (!$isFriendly) {
            if (cache()->has('blocked_ip_' . $ip)) {
                abort(403);
            }

            $cacheKey = 'visit_count_' . $ip;
            $visitCount = cache()->increment($cacheKey); // increment daha sürətlidir

            if ($visitCount === 1) {
                cache()->put($cacheKey, 1, now()->addMinutes(60));
            }

            if (($isBot && !$isFriendly) || (!$isFriendly && $visitCount > 10)) {
                cache()->put('blocked_ip_' . $ip, true, now()->addDay());
                Log::alert("IP LIMITI AŞDI VƏ BLOKLANDI: $ip");
                abort(403);
            }
        }

        // 5. Məlumatların hazırlanması və Job-a ötürülməsi
        try {
            $data = [
                'ip_address' => $ip,
                'browser' => $isBot ? $robotName : $agent->browser(),
                'os' => $agent->platform(),
                'is_bot' => $isBot && !$isFriendly, // Yaxşı botları bazada bot kimi işarələməyə bilərsən
                'user_agent' => $userAgent,
                'url' => $request->fullUrl(),
                'referer' => $request->headers->get('referer'),
                'language' => $request->getPreferredLanguage(),
            ];

            dispatch(new LogVisitJob($data));

        } catch (\Exception $e) {
            Log::error("LogVisit Middleware Xətası: " . $e->getMessage());
        }

        return $next($request);
    }

}
