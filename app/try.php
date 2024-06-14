<?php
function encrypt($data, $key)
{
    $iv_length = openssl_cipher_iv_length('aes-256-cbc');
    $iv = openssl_random_pseudo_bytes($iv_length); // Generate IV
    $salt = openssl_random_pseudo_bytes(16); // Generate 16 bytes salt
    $iterations = 100000; // Increased iterations for PBKDF2
    $salted_key = hash_pbkdf2('sha256', $key, $salt, $iterations, 32, true); // Generate salted key
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $salted_key, 0, $iv); // Encrypt the data
    // Concatenate salt, IV, and encrypted data
    return base64_encode($salt . $iv . $encrypted);
}

function decrypt($data, $key)
{
    $data = base64_decode($data); // Decode base64 string
    $iv_length = openssl_cipher_iv_length('aes-256-cbc');
    $salt_length = 16; // Salt length
    // Extract salt
    $salt = substr($data, 0, $salt_length);
    // Extract IV
    $iv = substr($data, $salt_length, $iv_length);
    // Extract encrypted data
    $encrypted = substr($data, $salt_length + $iv_length);
    $iterations = 100000; // Use the same number of iterations as in the encryption process
    // Generate salted key using the same salt
    $salted_key = hash_pbkdf2('sha256', $key, $salt, $iterations, 32, true);
    // Decrypt the data
    return openssl_decrypt($encrypted, 'aes-256-cbc', $salted_key, 0, $iv);
}

// Securely get encryption key from environment variable
$encryption_key = getenv('ENCRYPTION_KEY');
if (!$encryption_key) {
    die('Encryption key not set in environment variable');
}

// Encrypt data
$encrypted_data = encrypt('mshahi.biz@gmail.com', $encryption_key);
