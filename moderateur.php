<?php

include "header.admin.php";
include "sql.php";
include "fonction_blog.php";

?>

<?php
////////////////////////////////////////////////////////
////////////////// si user autre que admin ////////////
//////////////////////////////////////////////////////
if ($_SESSION["lvl"] != 2) 
{
header('Location: login.php');
}
?>

<?php
@$valider = $_POST["valider"];
@$id_view = $_POST["id_view"];
@$supprime = $_POST["supprime"];

if ($valider) 
{
valid_view($id_view);
}

if ($supprime) 
{
delete_view($id_view);
}


$unique = uniqid();

?>

<div class="moderation">
    <form action="moderateur.php" method="post">
   <?php $list_view = list_view_complet($id_view);?>
          <?php foreach ($list_view as $row) { ?>
            <div><?php echo $row->title_blog ?></div>
            <div><?php echo $row->id_blog ?></div>
            <div><?php echo $row->view ?></div>
            <input type="submit" name="valider" value="valider">
            <input type="hidden" class="btn" name="id_view" value="<?php echo $row->id_view ?>">
            <input type="submit" class="btn" name="supprime" value="supprimer">
           
            <hr>

       
    </form>
    <?php } ?>
</div>
<?php include "footer.php" ?>