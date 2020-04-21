<?php

include "sql.php";
include "cryptage.php";
include "fonction.php";
include "header.php";

if (isset($_POST["envoi"])) 
{
@$mail = htmlspecialchars($_POST['mail']);


if (isset($mail)) 
{
$recup_id = recup_id($mail);
$var1 = aesEncrypt($recup_id);
if ($mail == passe_oublie($mail)) {
sleep(1);
header('location:http://localhost/sybeatmaker/mailer.php?id=' . $var1 . '&mail=' . $mail);
ob_end_flush();
echo 'ok tu passes';
} 
else
{
$erreur = "l'adresse mail n'existe pas.";
}
}
}

?>

<div class="container mt-5">
    <div class="text-center">
        <p class="passe_oublie">Bienvenue sur la page mot de passe oublié.</p>
        <p class="passe_oublie_saisie">Merci de saisir votre adresse mail.</p>

    <form action="passe_oublie.php" method="post">
        <input type="email" name="_mail" placeholder="votre adresse mail" required>
        <input class="btn_motdepasse btn-light" type="submit" name="envoi" value="envoyer">
    </form>

<div class="container mt-5">
   <div class="text-center">
    <?php
    if (isset($erreur)) 
    {
    echo '<font color="red">' . $erreur . '</font>';
    } ?>
    </div>


</div>
</div>
</div>