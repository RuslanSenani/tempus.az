<?php

namespace App\Http\Middleware;

use App\Jobs\LogVisitJob;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;

class LogVisits
{
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();
        $userAgent = $request->userAgent() ?? '';

// 1. İLK ADDIM: Whitelist (Hər şeydən əvvəl)
// Bura mütləq öz sabit İP-ni və ofis İP-ni əlavə et
        if (in_array($ip, ['127.0.0.1', '::1', '37.61.124.14'])) {
            return $next($request);
        }

// 2. Kəşdən blok yoxlaması (Tez qərar vermək üçün)
        if (cache()->has('blocked_ip_' . $ip)) {
            $this->logAndAbort($request, $ip, 'BLOCKED_IP_RETRY');
        }

// 3. Zərərli User-Agent-lərin sürətli yoxlanışı
        $badAgents = ['WormGPT', 'Sqlmap', 'Nmap', 'AhrefsBot', 'MJ12bot', 'DotBot'];
        foreach ($badAgents as $bad) {
            if (str_contains($userAgent, $bad)) {
                $this->logAndAbort($request, $ip, 'BAD_USER_AGENT', true);
            }
        }

// 4. Təhlükəli yollar (Path trapping)
        if ($this->isDangerousPath($request->path())) {
            cache()->put('blocked_ip_' . $ip, true, now()->addDays(7)); // Təhlükəli yola girəni 7 gün blokla
            $this->logAndAbort($request, $ip, 'DANGEROUS_PATH_ACCESS', true);
        }

// 5. Bot Analizi (Yalnız bura qədər gələnlər üçün)
        $agent = new Agent();
        $isBot = $agent->isRobot();
        $robotName = $agent->robot();

// Dost bot siyahısını genişləndir  // 'bingbot', 'msnbot', 'YandexBot'
        $friendlyBots = ['Googlebot', 'DuckDuckBot'];
        $isFriendly = $isBot && $this->isFriendly($robotName, $friendlyBots);

// 6. Rate Limiting (Normal istifadəçi və ya qeyri-dost bot üçün)
        if (!$isFriendly) {
            $cacheKey = 'visit_count_' . $ip;
            $visitCount = cache()->increment($cacheKey);

            if ($visitCount === 1) {
                cache()->put($cacheKey, 1, now()->addMinutes(60));
            }

// Limit: İnsan üçün 100, naməlum bot üçün 20 (Daha real rəqəmlər)
            $limit = $isBot ? 20 : 100;

            if ($visitCount > $limit) {
                cache()->put('blocked_ip_' . $ip, true, now()->addDay());
                Log::alert("LIMIT AŞILDI: $ip (Count: $visitCount)");
                $this->logAndAbort($request, $ip, 'RATE_LIMIT_EXCEEDED', true);
            }
        }

// 7. Normal Ziyarət Logu (Arxa fonda Job-a göndərilir)
        $this->dispatchLog($request, $ip, $agent, $isBot, $isFriendly);

        return $next($request);
    }

// YARDIMÇI METODLAR (Kod təkrarını önləmək üçün)

    private function isDangerousPath($path)
    {
        $dangerousPaths = ['xmlrpc.php', 'wp-admin', '.env', 'phpinfo', 'f7.php', 'shell.php', 'config.php', 'setup.php', 'phpmyadmin'];
        foreach ($dangerousPaths as $badPath) {
            if (str_contains(strtolower($path), $badPath)) return true;
        }
        return false;
    }

    private function isFriendly($robotName, $friendlyBots)
    {
        foreach ($friendlyBots as $bot) {
            if (str_contains(strtolower($robotName), strtolower($bot))) return true;
        }
        return false;
    }

    private function logAndAbort($request, $ip, $reason, $shouldLog = true)
    {
        if ($shouldLog) {
            $agent = new Agent(); // Yalnız bloklananda Agent-i işə salırıq
            $this->dispatchLog($request, $ip, $agent, true, false);
        }
        abort(403, "Access Denied: $reason");
    }

    private function dispatchLog($request, $ip, $agent, $isBot, $isFriendly)
    {
        try {
            $data = [
                'ip_address' => $ip,
                'browser' => $isBot ? ($agent->robot() ?: 'Unknown Bot') : $agent->browser(),
                'os' => $agent->platform(),
                'is_bot' => $isBot && !$isFriendly,
                'user_agent' => $request->userAgent(),
                'url' => mb_strcut($request->fullUrl(), 0, 250), // Sənin aldığın o uzun URL xətasının qarşısı
                'referer' => $request->headers->get('referer'),
                'language' => $request->getPreferredLanguage(),
            ];
            dispatch(new LogVisitJob($data));
        } catch (\Exception $e) {
            Log::error("LogVisit Middleware Job Xətası: " . $e->getMessage());
        }
    }
}
