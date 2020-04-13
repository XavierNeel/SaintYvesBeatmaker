<?php
include "header.php";
include "sql.php";
include "fonction.php";
?>

<?php

if ($_POST) {
    @$login = $_POST["login"];
    @$passe = $_POST["passe"];

    verif_login($login, $passe);
}

?>


<h1>Connexion</h1>
<div class="login">

    <form action="login.php" method="post">

        <label for="">LOGIN</label>
        <br>
        <input type="text" class="form-control" name="login" value="" required>
        <br>
        <label for="">PASSWORD</label>
        <br>
        <input type="password" class="form-control" name="passe" value="" required>
        <br>
        
        <a class="mot"href="passe_oublie.php">mot de passe oublié?<span class="sr-only">(current)</span></a>
        <br />
        <input type="submit" class="btn " name="verifier" value="connexion">
        <input type="submit" class="btn " name="deconexion" value=" déconnexion" href="kill.php">


        <?php if (isset($_GET["message"])) { ?>
            <div>votre identifiants ne sont pas valides</div>

        <?php } ?>


    </form>
</div>











<?php include "footer.php" ?>