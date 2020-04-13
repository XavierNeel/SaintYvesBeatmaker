<?php
include "sql.php";
include "fonction.php";
include "header.php";


use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';



if ($_POST) {

    @$lastname = htmlspecialchars($_POST["lastname"]);
    @$firstname = htmlspecialchars($_POST["firstname"]);
    @$adress = htmlspecialchars($_POST["mail"]);
    @$login = htmlspecialchars($_POST["login"]);
    @$passe = htmlspecialchars($_POST["passe"]);
    $pass_hash =  decrypt($passe);
    $cle = md5(microtime(TRUE) * 100000);
    $responseKey = $_POST['g-recaptcha-response'];
    @$secretKey = "6LcO89oUAAAAAAT1Z25cgmzGJXW4UDFRC0EJSwv_";
    $userIP = $_SERVER['REMOTE_ADDR'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";

    $response = file_get_contents($url);
    $response = json_decode($response);

    if ($response->success) {
        echo "your name is $lastname";
    

    $lastname = htmlspecialchars($_POST["lastname"]);
    $add_login = add_login($lastname, $firstname, $adress,  $login, $pass_hash, $cle);

    


    $mail = new PHPmailer(true);

    
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP(); // Paramétrer le Mailer pour utiliser SMTP 
    $mail->Host = 'smtp.gmail.com'; // Spécifier le serveur SMTP
    $mail->SMTPAuth = true; // Activer authentication SMTP
    $mail->Username = 'xavierneel@gmail.com'; // Votre adresse email d'envoi
    $mail->Password = 'Adameteve20201'; // Le mot de passe de cette adresse email
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
    $mail->Body = 'Pour activer votre compte, veuillez cliquer sur le lien ci-dessous
ou copier/coller dans votre navigateur Internet. attention toutefois veuillez bien lire les mentions legales dans mention en bas de page du site.
 
http://localhost/sybeatmaker/activation.php?log=' . urlencode($login) . '&cle=' . urlencode($cle) . ""; 
 

    if (!$mail->send()) {
        echo 'Erreur, message non envoyé.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo  '"."Le message a bien été envoyé !';
    }
} else {
    echo "verification failed!";
}
}



?>


<h1>inscription</h1>
<div class="inscription">
    
    <form action="enregistrement.php" method="post">
        <label for="lastame">votre nom*</label>
        <br>
        <input type="text" name="lastname" value="" required>

        <br>

        <label for="firstname">Votre prenom*</label>
        <br>
        <input type="text" name="firstname" value="" required>

        <br>

        <label for="mail">Votre mail*</label>
        <br>
        <input type="email" name="mail" value="" required>

        <br>

        <label for="login">login*</label>
        <br>
        <input type="text" name="login" value="" required>

        <br>

        <label for="passe">Votre mot de passe*</label>
        <br>
        <input type="password" name="passe" value="" required>

        <br>

        <div> <input type="hidden" name="cle" value="<?php echo @$cle ?>"></div>
     
        <div class="g-recaptcha" data-sitekey="6LcO89oUAAAAAAmSFsdnOZqhcsJMNy-If9qPF4KX"></div>
  
        <br>
        <input type="submit" class="btn" name="submit" value="s'inscrire">
        <br>

    </form>
</div>
<script src='https://www.google.com/recaptcha/api.js'></script>






<?php include "footer.php"; ?>