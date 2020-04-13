<?php
include "sql.php";
include "fonction.php";
include "header.php";
@$mail =    recup_id($mail);
@$mail = $_GET['mail'];
@$recup_id = $_GET['id'];
// @$pass_hash =  cryptage($recup_id);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';



$mail = new PHPmailer(true);
$mail->CharSet = 'UTF-8';

// $mail->SMTPDebug = SMTP::DEBUG_SERVER;
$mail->isSMTP(); // Paramétrer le Mailer pour utiliser SMTP
$mail->Host = 'smtp.gmail.com'; // Spécifier le serveur SMTP
$mail->SMTPAuth = true; // Activer authentication SMTP
$mail->Username = 'xavierneel@gmail.com'; // Votre adresse email d'envoi
$mail->Password = 'Adameteve1'; // Le mot de passe de cette adresse email
$mail->SMTPSecure = 'ssl'; // Accepter SSL
$mail->Port = 465;

$mail->setFrom('xavierneel@gmail.com', 'gmail'); // Personnaliser l'envoyeur
$mail->addAddress('xavierneel@gmail.com', 'xavier'); // Ajouter le destinataire
// $mail->addAddress('To2@example.com');
// $mail->addReplyTo('info@example.com', 'Information'); // L'adresse de réponse
//$mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');

// $mail->addAttachment('/var/tmp/file.tar.gz'); // Ajouter un attachement
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');
$mail->isHTML(true); // Paramétrer le format des emails en HTML ou non

$mail->Subject = "Mot de passe oublié";
$mail->Body = 'Bonjour,<br> merci de cliquer sur le lien suivant pour modifier votre mot de passe.<br>http://localhost/sybeatmaker/chgtpasse.php?id=' . $recup_id;
$mail->AltBody = 'A bientôt' . '<br>';



if (!$mail->send()) {
    echo 'Erreur, message non envoyé.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Le message a bien été envoyé !';
    header('http://localhost/sybeatmaker/mdpoublie.php');
    exit();
}
