<?php

declare(strict_types=1);

namespace App\Support;

use RuntimeException;
use SodiumException;

final class IdCipher
{
    private static ?string $key = null;

    private static int $nonceLen = SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES;

    private static int $keyLen = SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_KEYBYTES;

    public static function encode(int|string $value): string
    {
        self::ensureInitialized();

        $plaintext = (string) $value;
        if ($plaintext === '') {
            throw new RuntimeException('Nilai tidak boleh kosong.');
        }

        $nonce = self::deriveNonce($plaintext);
        $ciphertext = sodium_crypto_aead_xchacha20poly1305_ietf_encrypt(
            $plaintext,
            '',
            $nonce,
            self::$key
        );

        return sodium_bin2base64(
            $ciphertext,
            SODIUM_BASE64_VARIANT_URLSAFE_NO_PADDING
        );
    }

    public static function decode(?string $token): ?string
    {
        if (empty($token)) {
            return null;
        }

        try {
            self::ensureInitialized();

            $ciphertext = sodium_base642bin(
                $token,
                SODIUM_BASE64_VARIANT_URLSAFE_NO_PADDING
            );

            $minLength = SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_ABYTES;
            if (strlen($ciphertext) < $minLength) {
                return null;
            }

            $plaintext = null;
            for ($attempt = 0; $attempt < 1000; $attempt++) {
                $testNonce = self::deriveNonce((string) $attempt);
                try {
                    $result = sodium_crypto_aead_xchacha20poly1305_ietf_decrypt(
                        $ciphertext,
                        '',
                        $testNonce,
                        self::$key
                    );
                    if ($result !== false) {
                        $plaintext = $result;
                        break;
                    }
                } catch (SodiumException) {
                    continue;
                }
            }

            return $plaintext;
        } catch (SodiumException) {
            return null;
        } catch (\Throwable) {
            return null;
        }
    }

    private static function deriveNonce(string $data): string
    {
        return sodium_crypto_generichash(
            $data.config('app.key'),
            '',
            self::$nonceLen
        );
    }

    private static function ensureInitialized(): void
    {
        if (self::$key !== null) {
            return;
        }

        self::$key = self::deriveKeyFromAppKey();
    }

    private static function deriveKeyFromAppKey(): string
    {
        $appKey = config('app.key');

        if (! is_string($appKey) || $appKey === '') {
            throw new RuntimeException('APP_KEY tidak terkonfigurasi.');
        }

        if (str_starts_with($appKey, 'base64:')) {
            $appKey = base64_decode(substr($appKey, 7), true);

            if ($appKey === false) {
                throw new RuntimeException('APP_KEY format base64 tidak valid.');
            }
        }

        return strlen($appKey) === self::$keyLen
            ? $appKey
            : sodium_crypto_generichash($appKey, '', self::$keyLen);
    }
}
