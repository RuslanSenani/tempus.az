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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next)
    {


        $ip = $request->ip();
        $agent = new Agent();

        // Lokal IP yoxlaması
//        if (in_array($ip, ['127.0.0.1', '192.168.1.1'])) {
//            return $next($request);
//        }

        // Cache yoxlaması
        $cacheKey = 'visit_count_' . $ip;
        $visitCount = cache()->get($cacheKey, 0);


        if ($visitCount > 100) {
            cache()->put('blocked_ip_' . $ip, true, now()->addHour());
            abort(403);
        }

        if (cache()->has('blocked_ip_' . $ip)) {
            abort(403);
        }

        cache()->put($cacheKey, $visitCount + 1, 60);

        // ƏN KRİTİK HİSSƏ: Verilənlərin hazırlanması
        try {
            $data = [
                'ip_address' => $ip,
                'browser'    => $agent->browser(),
                'os'         => $agent->platform(),
                'is_bot'     => $agent->isRobot(),
                'user_agent' => $request->userAgent(),
                'url'        => $request->fullUrl(),
                'referer'    => $request->headers->get('referer'),
                'language'   => $request->getPreferredLanguage(),
                'updated_at' => now(),
            ];


            dispatch(new LogVisitJob($data));

        } catch (\Exception $e) {
            Log::error("XƏTA BAŞ VERDİ: " . $e->getMessage());
        }

        return $next($request);
    }
}
