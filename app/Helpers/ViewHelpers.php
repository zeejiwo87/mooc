<?php

use Illuminate\Support\Str;

if (! function_exists('formatMinutes')) {
    function formatMinutes($totalMinutes)
    {
        $totalMinutes = (int) $totalMinutes;
        $hours = intdiv($totalMinutes, 60);
        $minutes = $totalMinutes % 60;
        $result = '';

        if ($hours > 0) {
            $result .= $hours . ' jam ';
        }

        if ($minutes > 0) {
            $result .= $minutes . ' mnt';
        }

        return trim($result) ?: '0 mnt';
    }
}

if (! function_exists('formatSeconds')) {
    function formatSeconds($seconds)
    {
        $seconds = (int) $seconds;

        if ($seconds <= 0) {
            return '';
        }

        $m = intdiv($seconds, 60);
        $s = $seconds % 60;

        if ($m > 0 && $s > 0) {
            return $m . ' mnt ' . $s . ' dtk';
        } elseif ($m > 0) {
            return $m . ' mnt';
        }

        return $s . ' dtk';
    }
}

if (! function_exists('youtubeVideoId')) {
    function youtubeVideoId(?string $url): ?string
    {
        if (! $url) {
            return null;
        }

        $url = trim($url);

        if ($url === '') {
            return null;
        }

        /**
         * Kalau user hanya input ID video langsung:
         * contoh: dQw4w9WgXcQ
         */
        if (preg_match('/^[a-zA-Z0-9_-]{11}$/', $url)) {
            return $url;
        }

        /**
         * Kalau user input URL tanpa https://
         * contoh: youtube.com/watch?v=dQw4w9WgXcQ
         */
        if (! Str::startsWith($url, ['http://', 'https://'])) {
            $url = 'https://' . $url;
        }

        $parts = parse_url($url);

        if (! is_array($parts)) {
            return null;
        }

        $host = strtolower($parts['host'] ?? '');
        $path = trim($parts['path'] ?? '', '/');
        $queryString = $parts['query'] ?? '';

        $query = [];
        parse_str($queryString, $query);

        $videoId = null;

        if (! empty($query['v'])) {
            $videoId = $query['v'];
        } elseif (Str::contains($host, 'youtu.be')) {
            $segments = array_values(array_filter(explode('/', $path)));
            $videoId = $segments[0] ?? null;
        } elseif (
            Str::contains($host, 'youtube.com') ||
            Str::contains($host, 'youtube-nocookie.com')
        ) {
            $segments = array_values(array_filter(explode('/', $path)));

            if (
                count($segments) >= 2 &&
                in_array($segments[0], ['embed', 'shorts', 'live', 'v', 'e'], true)
            ) {
                $videoId = $segments[1];
            }
        }

        if (! $videoId) {
            return null;
        }

        /**
         * Ambil hanya pola video ID YouTube yang valid.
         * Jangan digabung pakai preg_replace karena bisa menghasilkan ID palsu.
         */
        if (preg_match('/^[a-zA-Z0-9_-]{11}$/', $videoId)) {
            return $videoId;
        }

        if (preg_match('/([a-zA-Z0-9_-]{11})/', $videoId, $matches)) {
            return $matches[1];
        }

        return null;
    }
}

if (! function_exists('toEmbedUrl')) {
    function toEmbedUrl(?string $url, bool $autoplay = false): ?string
    {
        if (! $url) {
            return null;
        }

        $url = trim($url);

        if ($url === '') {
            return null;
        }

        $videoId = youtubeVideoId($url);

        if ($videoId) {
            $params = [
                'rel' => 0,
                'modestbranding' => 1,
                'playsinline' => 1,
            ];

            if ($autoplay) {
                $params['autoplay'] = 1;
                $params['mute'] = 1;
            }

            return 'https://www.youtube.com/embed/' . $videoId . '?' . http_build_query($params);
        }

        return $url;
    }
}

if (! function_exists('youtubeWatchUrl')) {
    function youtubeWatchUrl(?string $url): ?string
    {
        if (! $url) {
            return null;
        }

        $url = trim($url);

        if ($url === '') {
            return null;
        }

        $videoId = youtubeVideoId($url);

        if ($videoId) {
            return 'https://www.youtube.com/watch?v=' . $videoId;
        }

        return $url;
    }
}