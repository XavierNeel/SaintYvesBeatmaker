<?php
// Automation of openssl_encrypt
function aesEncrypt($val)
{
    return bin2hex(openssl_encrypt($val, 'aes-256-cbc', AES_KEY, OPENSSL_RAW_DATA, AES_IV));
}
//==============================================
// Automation of openssl_decrypt 

function aesDecrypt($val)
{
    return openssl_decrypt(hex2bin($val), 'aes-256-cbc', AES_KEY, OPENSSL_RAW_DATA, AES_IV);
}
