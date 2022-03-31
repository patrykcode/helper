<?php

class Enigma
{
    private static $instance = null;
    private $key = '';
    private $string = '';

    public function __construct($string, $key)
    {
        $this->key = $key;
        $this->string = $string;
    }
    
    public static function gi($string='', $key='YOU_SECRET_KEY')
    {
        if (is_null(self::$instance)) {
            self::$instance = new self($string, $key);
        }
        return self::$instance;
    }

    public function encrypt($payload)
    {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($payload, 'aes-256-cbc', $this->key, 0, $iv);
        return base64_encode($encrypted . '::' . $iv);
    }

    public function decrypt($garble)
    {
        list($encrypted_data, $iv) = explode('::', base64_decode($garble), 2);
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', $this->key, 0, $iv);
    }
}
