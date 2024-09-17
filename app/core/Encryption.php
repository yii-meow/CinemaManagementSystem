<?php

namespace App\core;

use Dotenv\Dotenv;

class Encryption
{

    private $key;

    public function __construct() {
        //Get the Cryptographic key from the separate .env file, as environment variable.
        $this->key = getenv("CRYTOKEY");
    }

    // Encrypt Data
    public function encrypt(string $data, string $key) {
        $encryption_key = base64_decode($this->key);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
        if ($encrypted === false) {
            throw new \Exception("Encryption failed.");
        }
        return base64_encode($encrypted . '::' . base64_encode($iv));
    }

    // Decrypt Data
    public function decrypt(string $data, string $key) {
        $encryption_key = base64_decode($this->key);
        list($encrypted_data, $encoded_iv) = explode('::', base64_decode($data), 2);
        $iv = base64_decode($encoded_iv);

        if (strlen($iv) !== openssl_cipher_iv_length('aes-256-cbc')) {
            throw new \Exception("Invalid IV length.");
        }

        $decrypted = openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
        if ($decrypted === false) {
            throw new \Exception("Decryption failed.");
        }
        return $decrypted;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function setKey(string $key): void
    {
        $this->key = $key;
    }
}