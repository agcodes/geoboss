<?php

namespace App\Services;


final class SecretService
{
	private $cryptKey;

	public function __construct($cryptKey)
	{
		$this->cryptKey = $cryptKey;
	}

	public function encryptIt($q)
	{
		$ivSize = openssl_cipher_iv_length('aes-256-cbc');
		$iv = openssl_random_pseudo_bytes($ivSize);
		$qEncoded = openssl_encrypt($q, 'aes-256-cbc', $this->cryptKey, 0, $iv);
		return base64_encode($iv . $qEncoded);
	}

	public function decryptIt($q)
	{
		$q = base64_decode($q);
		$ivSize = openssl_cipher_iv_length('aes-256-cbc');
		$iv = substr($q, 0, $ivSize);
		$q = substr($q, $ivSize);
		return openssl_decrypt($q, 'aes-256-cbc', $this->cryptKey, 0, $iv);
	}
}
