<?php

const KEY = '654567324578';

function cryptData($data) {

    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);

    $ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, KEY, $data, MCRYPT_MODE_CBC, $iv);
    $ciphertext = $iv . $ciphertext;

    return base64_encode($ciphertext);
}

function decryptData($data) {
    $ciphertext = base64_decode($data);
    $iv_size    = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
    $iv         = substr($ciphertext, 0, $iv_size);
    $ciphertext = substr($ciphertext, $iv_size);
    $original = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, KEY, $ciphertext, MCRYPT_MODE_CBC, $iv);

    return rtrim($original, "\0");
}
