<?php

namespace App\Helpers;

final class Tools
{
    public static function isPrivateIp(string $ip): bool
    {
        return self::isIpInRange($ip, '172.16.0.0', '172.31.255.255') || self::isIpInRange($ip, '10.0.0.0', '10.255.255.255') || self::isIpInRange($ip, '192.168.0.0', '192.168.255.255');
    }

    private static function isIpInRange(string $ip, string $start, string $end): bool
    {
        if ($ip === '127.0.0.1' || $ip === '::1') {
            return true;
        }
        if (! filter_var($ip, FILTER_VALIDATE_IP)) {
            return false;
        }
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $ipLong = ip2long($ip);

            return $ipLong >= ip2long($start) && $ipLong <= ip2long($end);
        }

        return false;
    }

    public static function formatTanggalIndonesia($tanggal): string
    {
        $bulanIndo = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        if ($tanggal instanceof \DateTimeInterface) {
            $timestamp = $tanggal->getTimestamp();
        } else {
            $timestamp = strtotime($tanggal);
        }

        if (! $timestamp) {
            return '';
        }

        $hari = date('d', $timestamp);
        $bulan = $bulanIndo[(int) date('m', $timestamp)];
        $tahun = date('Y', $timestamp);

        return $hari.' '.$bulan.' '.$tahun;
    }
}
