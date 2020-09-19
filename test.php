<?php

$chaine = "Le PHP c'est simple !";
    $key_password = "la clé";

    // CRYPTER
    function aesEncrypt($chaine)
    {
      $key_password = "la clé";
      $encrypted_chaine = openssl_encrypt($chaine, "AES-128-ECB" ,$key_password);
      var_dump( $encrypted_chaine);
  
    }

   $messagecrypte= aesEncrypt($chaine);
    // Affiche : string 'QlzbS3go1q/qBfykOxDj+g==' (length=24)



    // DECRYPTER
    function aesdecrypt($encrypted_chaine)
    {
      $key_password = "la clé";
      $decrypted_chaine = openssl_decrypt($encrypted_chaine, "AES-128-ECB" ,$key_password);
      var_dump($encrypted_chaine);
  
    }

    $messagedecrypte= aesdecrypt($chaine);
    // Affiche : string 'Le PHP c'est simple !' (length=21)
