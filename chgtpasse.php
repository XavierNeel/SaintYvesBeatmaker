<?php
include "sql.php";
include "cryptage.php";
include "fonction.php";
include "header.php";


$id_user = $_GET['id'];

if (isset($_POST)) {
    @$id_user = htmlspecialchars($_POST["id_user"]);
    $id_user = $_GET['id'];

    @$passe = htmlspecialchars($_POST['passe']);
    @$mot_de_passe2 = htmlspecialchars($_POST['mot_de_passe2']);
    @$modifier = htmlspecialchars($_POST['modifier']);
    $pass_hash =  decrypt($passe);
    //var_dump($id_user);

    if ($modifier)

        if ($passe == $mot_de_passe2) {

            if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{6,}$#', $passe)) {
                sleep(1);
                //echo 'ok mdp modifié';
                modifier_motdepasse($id_user, $passe);
                header('location:rmc.php');
                ob_start();
                exit();
            } else {
                $erreur = 'Niveau de sécurité trop faible';
            }
        } else {
            $erreur = 'Vos mot de passe ne correspondent pas, merci de retaper votre mot de passe';
        }
}
if (isset($_GET["id"])) {
    $id_user = $_GET["id"];

    $var2 = aesDecrypt($id_user);
    //echo $var2;
    if (verification_id($var2)) {
        //echo 'ok tu passes';
        //echo  $verification_id;
    } else {
        //$erreur = "Vous n'avez pas copié le bon lien ou merci de contacter l'administrateur";
        // header('location:login.php');
        ob_end_flush();
    }
} else {
    echo 'Erreur pas id ';
}
?>


<div class="container mt-5">

    <div class="text-center">
        <?php
        if (isset($erreur)) {
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