<?php
function encryptText($text, $key)
{
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($text, 'aes-256-cbc', $key, 0, $iv);
    return base64_encode($iv . $encrypted);
}

function decryptText($encryptedText, $key)
{
    $data = base64_decode($encryptedText);
    $ivSize = openssl_cipher_iv_length('aes-256-cbc');
    $iv = substr($data, 0, $ivSize);
    $encrypted = substr($data, $ivSize);
    return openssl_decrypt($encrypted, 'aes-256-cbc', $key, 0, $iv);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['encrypt'])) {
        $plaintext = $_POST['plaintext'];
        $encryptionKey = $_POST['encryptionkey'];
        $encryptedText = encryptText($plaintext, $encryptionKey);
        echo "<h3>Encrypted Text:</h3>";
        echo "<p>$encryptedText</p>";
    } else if (isset($_POST['decrypt'])) {
        $encryptedText = $_POST['encryptedText'];
        $decryptionKey = $_POST['decryptionKey'];
        $decryptedText = decryptText($encryptedText, $decryptionKey);
        echo "<h3>Decrypted Text:</h3>";
        echo "<p>$decryptedText</p>";
    }
}
