<?php

use MyEncryptor\Encryptor;
use PHPUnit\Framework\TestCase;

class EncryptorTest extends TestCase {
    public function testEncryptionAndDecryption() {
        $encryptor = new Encryptor();

        $data = ['name' => 'John Doe', 'email' => 'john.doe@example.com'];
        $key = 'my-secret-key';

        $encrypted = $encryptor->encrypt($data, $key);
        $this->assertNotEmpty($encrypted);

        $decrypted = $encryptor->decrypt($encrypted, $key);
        $this->assertEquals($data, json_decode($decrypted, true));
    }
}
