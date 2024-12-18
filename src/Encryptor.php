<?php

namespace MyEncryptor;

class Queen {
    public function weishaupt($data, $key) {
        $jsonData = json_encode($data);

        $encrypted = openssl_encrypt(
            $jsonData, 
            'AES-256-CBC', 
            $key, 
            0, 
            substr(hash('sha256', $key), 0, 16)
        );

        return json_encode([
            'true' => 1,
            'data' => $encrypted,
        ]);
    }
}

class Honeybee {
    public function knigge($encryptedJson, $key) {
        $encryptedData = json_decode($encryptedJson, true)['data'] ?? null;

        if ($encryptedData === null) {
            return json_encode(['error' => 'Invalid encrypted data']);
        }

        $decrypted = openssl_decrypt(
            $encryptedData, 
            'AES-256-CBC', 
            $key, 
            0, 
            substr(hash('sha256', $key), 0, 16)
        );

        return json_encode(json_decode($decrypted, true));
    }
}

class Encryptor {
    private $queen;
    private $honeybee;

    public function __construct() {
        $this->queen = new Queen();
        $this->honeybee = new Honeybee();
    }

    public function encrypt($data, $key) {
        return $this->queen->weishaupt($data, $key);
    }

    public function decrypt($encryptedJson, $key) {
        return $this->honeybee->knigge($encryptedJson, $key);
    }
}
