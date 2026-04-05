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

        // 1. Whitelist - Özünü heç vaxt bloklama
        if (in_array($ip, ['127.0.0.1', '::1', '37.61.124.14'])) {
            return $next($request);
        }

        // 2. Cache-dən sürətli blok yoxlaması
        if (cache()->has('blocked_ip_' . $ip)) {
            $this->logAndAbort($request, $ip, 'RECURRING_BLOCK_TRY', false);
        }

        // 3. Şübhəli boş başlıqlar (Real insanlarda UA boş olmur)
        if (empty($userAgent) || strlen($userAgent) < 15) {
            $this->logAndAbort($request, $ip, 'EMPTY_OR_SHORT_UA', true);
        }

        // 4. Zərərli Agentlərin siyahısını genişləndirək
        $badAgents = [
            'WormGPT', 'Sqlmap', 'Nmap', 'AhrefsBot', 'MJ12bot', 'DotBot',
            'Python', 'aiohttp', 'Requests', 'curl', 'Wget', 'Go-http-client',
            'Palo Alto Networks', 'CensysInspect', 'NetSystemsExe', 'Zgrab'
        ];
        foreach ($badAgents as $bad) {
            if (str_contains(strtolower($userAgent), strtolower($bad))) {
                $this->logAndAbort($request, $ip, 'MALICIOUS_AGENT', true);
            }
        }

        // 5. Təhlükəli yollar (Path trapping) - Siyahını sənə gələn hücumlara görə artırdım
        if ($this->isDangerousPath($request->path())) {
            cache()->put('blocked_ip_' . $ip, true, now()->addDays(7));
            $this->logAndAbort($request, $ip, 'HACKING_ATTEMPT', true);
        }

        // 6. Bot Analizi
        $agent = new Agent();
        $isBot = $agent->isRobot();
        $robotName = $agent->robot();

        $friendlyBots = ['googlebot', 'duckduckbot', 'bingbot', 'msnbot', 'yandexbot', 'applebot'];
        $isFriendly = $isBot && $this->isFriendly($robotName, $friendlyBots);

        // --- HİYLƏGƏR BOTLARI TUTMAQ ÜÇÜN KRİTİK YOXLA (HEURISTICS) ---
        if (!$isFriendly) {
            $os = $agent->platform();
            $browser = $agent->browser();

            // Qayda A: Əgər brauzer Chrome/Safari deyir, amma OS "Unknown" gəlirsə - bu botdur.
            if (($browser == 'Chrome' || $browser == 'Safari') && $os == 'Unknown') {
                cache()->put('blocked_ip_' . $ip, true, now()->addDay());
                $this->logAndAbort($request, $ip, 'FAKE_BROWSER_NO_OS', true);
            }

            // Qayda B: Əgər sənə bayaq gələn "Aiohttp" kimi bir şey gəlibsə və isRobot hələ tutmayıbsa
            if (str_contains(strtolower($userAgent), 'aiohttp') || str_contains(strtolower($userAgent), 'python')) {
                cache()->put('blocked_ip_' . $ip, true, now()->addDay());
                $this->logAndAbort($request, $ip, 'PROGRAMMATIC_BOT', true);
            }
        }

        // 7. Rate Limiting
        if (!$isFriendly) {
            $cacheKey = 'visit_count_' . $ip;
            $visitCount = cache()->increment($cacheKey);

            if ($visitCount === 1) {
                cache()->put($cacheKey, 1, now()->addMinutes(60));
            }

            // Limitləri bir az sərtləşdirək (Naməlumlar üçün)
            $limit = $isBot ? 15 : 80;

            if ($visitCount > $limit) {
                cache()->put('blocked_ip_' . $ip, true, now()->addDay());
                Log::alert("RATE LIMIT: $ip (Count: $visitCount)");
                $this->logAndAbort($request, $ip, 'TOO_MANY_REQUESTS', true);
            }
        }

        // 8. Normal Log
        $this->dispatchLog($request, $ip, $agent, $isBot, $isFriendly);

        return $next($request);
    }

    private function isDangerousPath($path)
    {
        $dangerousPaths = [
            'xmlrpc.php', 'wp-admin', '.env', 'phpinfo', 'f7.php', 'shell.php',
            'config.php', 'setup.php', 'phpmyadmin', 'rip.php', 'eval-stdin.php',
            'actuator', '.git', 'backup'
        ];
        foreach ($dangerousPaths as $badPath) {
            if (str_contains(strtolower($path), $badPath)) return true;
        }
        return false;
    }

    private function isFriendly($robotName, $friendlyBots)
    {
        if (!$robotName) return false;
        foreach ($friendlyBots as $bot) {
            if (str_contains(strtolower($robotName), strtolower($bot))) return true;
        }
        return false;
    }

    private function logAndAbort($request, $ip, $reason, $shouldLog = true)
    {
        if ($shouldLog) {
            $agent = new Agent();
            $this->dispatchLog($request, $ip, $agent, true, false, $reason);
        }
        abort(403, "Forbidden: $reason");
    }

    private function dispatchLog($request, $ip, $agent, $isBot, $isFriendly, $reason = null)
    {
        try {
            $data = [
                'ip_address' => $ip,
                'browser'    => $isBot ? ($agent->robot() ?: 'Bot/Script') : $agent->browser(),
                'os'         => $agent->platform() ?: 'Unknown',
                'is_bot'     => $isBot && !$isFriendly,
                'user_agent' => mb_strcut($request->userAgent(), 0, 500),
                'url'        => mb_strcut($request->fullUrl(), 0, 250),
                'referer'    => mb_strcut($request->headers->get('referer'), 0, 250),
                'language'   => $request->getPreferredLanguage(),
                // 'reason'  => $reason, // Əgər bazada sütun açsan bunu da əlavə et, çox faydalıdır
            ];
            dispatch(new LogVisitJob($data));
        } catch (\Exception $e) {
            Log::error("LogVisit Job Error: " . $e->getMessage());
        }
    }
}
