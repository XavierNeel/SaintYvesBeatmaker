<?php

include "sql.php";
include "cryptage.php";
include "fonction.php";
include "header.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
    
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


if ($_POST) 
{

@$mail= htmlspecialchars($_POST["mail"]);
@$adress = htmlspecialchars($_POST["mail"]);
$recup_id = recup_id($mail);
$var1 = aesEncrypt($recup_id);



// $userIP = $_SERVER['REMOTE_ADDR'];
    $mail = new PHPmailer(true);
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP(); // Paramétrer le Mailer pour utiliser SMTP 
    $mail->Host = 'smtp.gmail.com'; // Spécifier le serveur SMTP
    $mail->SMTPAuth = true; // Activer authentication SMTP
    $mail->Username = 'xavierneel@gmail.com'; // Votre adresse email d'envoi
    $mail->Password = 'Adameteve1979&'; // Le mot de passe de cette adresse email
    $mail->SMTPSecure = 'ssl'; // Accepter SSL
    $mail->Port = 465;
    $mail->setFrom('xavierneel@gmail.com', 'gmail'); // Personnaliser l'envoyeur
    $mail->addAddress($adress); // Ajouter le destinataire
    // $mail->addAddress('To2@example.com');
    // $mail->addReplyTo('info@example.com', 'Information'); // L'adresse de réponse
    //$mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');
    // $mail->addAttachment('/var/tmp/file.tar.gz'); // Ajouter un attachement
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');
    $mail->isHTML(true); // Paramétrer le format des emails en HTML ou non
    $mail->Subject = 'Bienvenue sur SaintYvesBeatmaker.com,';
    $mail->Body = 'Bonjour,<br> merci de cliquer sur le lien suivant pour modifier votre mot de passe.<br>http://saintyvesbeatmaker/chgtpasse.php?id=' . $var1;
 

    if (!$mail->send()) 
    {
    echo 'Erreur, message non envoyé.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    }

    else 
    {
    echo  '"."Le message a bien été envoyé !';
    }



}

?>

<div class="container mt-5">
    <div class="text-center">
        <p class="passe_oublie">Bienvenue sur la page mot de passe oublié.</p>
        <p class="passe_oublie_saisie">Merci de saisir votre adresse mail.</p>

    <form action="passe_oublie.php" method="post">
        <input type="email" name="mail" placeholder="votre adresse mail" required>
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


<?php include "footer.php"; ?>