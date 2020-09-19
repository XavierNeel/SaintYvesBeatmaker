<?php

function aesEncrypt($recup_id)
{
return bin2hex(openssl_encrypt($recup_id, 'aes-256-cbc', AES_KEY, OPENSSL_RAW_DATA, AES_IV));
}
//==============================================
// Automation of openssl_decrypt 

function aesDecrypt($var1)
{
return openssl_decrypt(hex2bin($var1), 'aes-256-cbc', AES_KEY, OPENSSL_RAW_DATA, AES_IV);
}