<?php

include "sql.php";
include "cryptage.php";
include "fonction.php";
include "header.php";




if (isset($_POST)) 
{
@$id_user = htmlspecialchars($_POST["id_user"]);
@$var1 = $_GET['id'];
@$passe = htmlspecialchars($_POST['passe']);
@$mot_de_passe2 = htmlspecialchars($_POST['mot_de_passe2']);
@$modifier = htmlspecialchars($_POST['modifier']);
$pass_hash =  decrypt($passe);
   
if ($modifier)

if ($passe == $mot_de_passe2) 
{

if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{6,}$#', $passe)) {
    sleep(1);
    modifier_motdepasse($id_user, $passe);
    header('location:rmc.php');
    ob_start();
    exit();
    } else 
    {
    $erreur = 'Niveau de sécurité trop faible';
    }

    } 
    else 
    {
    $erreur = 'Vos mot de passe ne correspondent pas, merci de retaper votre mot de passe';
    }
}

if (isset($_GET["id"])) {
    
$var1 = $_GET["id"]; 
$var2 = aesDecrypt($var1);
var_dump($var1);
var_dump($var2);
?>

<?php 
@$mail= htmlspecialchars($_POST["mail"]);
@$id_user = htmlspecialchars($_POST["id_user"]);

// var_dump($verif);
$verif = verification_id();
foreach ($verif as $row) { ?>
<?php echo stripslashes($row->mail) ?>
    <?php      
$var2 = aesDecrypt($var1);
if  (verification_id()) 
{
   
    
echo 'ok tu passes';

} 

else 
{
$erreur = "Vous n'avez pas copié le bon lien ou merci de contacter l'administrateur";
// header('location:login.php');
ob_end_flush();
} 
?>  <?php } ?>
    <?php




} 
else 
{
echo 'Erreur pas id ';
}

?>

<div class="container mt-5">
   <div class="text-center">
    <?php
    if (isset($erreur)) 
    {
    echo '<font color="red">' . $erreur . '</font>';
    } ?>
    </div>

</div>

<div class="container mt-5">
    <div class="text-center">
        <p class="chgtpasse_partie2">Bienvenue.</p>
        <p class="chgtpasse_saisie">merci de saisir votre nouveau mot de passe</p>
        <form action="chgtpasse.php?id=<?php echo $id_user; ?>" method="post">
            <div class="col-md-12 mb-3">
                <div class="input-group">
                    <input type="password" name="passe" value="" placeholder="Nouveau mot de passe" class="form-control" id="validationServerUsername" aria-describedby="inputGroupPrepend3" data-toggle="tooltip" title="minimum 8 caractères avec au moins 1 majuscule 1 minuscule 1 caractère spécial et 1 chiffre" data-placement="right" required pattern=".{8,}">
                </div>
            </div>
            <div class=" col-md-12 mb-3">
              <div class="input-group">
            <input type="password" name="mot_de_passe2" value="" placeholder="retaper votre mot de passe" class="form-control" id="validationServerUsername" data-toggle="tooltip" title="minimum 8 caractères avec au moins 1 majuscule 1 minuscule 1 caractère spécial et 1 chiffre" data-placement="right" aria-describedby="inputGroupPrepend3" required pattern=".{8,}">
             </div>
            </div>
            <input class=" btn_motdepasse2" type="submit" name="modifier" value="modifier">
            </form>
            <a class="navbar-brand mt-5" href="#"></a>
    </div>
</div>


