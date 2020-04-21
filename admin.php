<?php

include "header.admin.php";
include "sql.php";
include "fonction.php";

?>

<?php

if ($_SESSION["lvl"] != 1) 
{
header('Location: login.php');
}

if ($_POST) {

@$modifier = htmlspecialchars($_POST["modifier"]);
@$id_link = htmlspecialchars($_POST["id_link"]);
@$id_cat = htmlspecialchars($_POST["id_cat"]);
@$title_link = htmlspecialchars($_POST["title_link"]);
@$id_user = htmlspecialchars($_POST["id_user"]);
@$link =  htmlspecialchars($_POST["link"]);
@$ajouter =  htmlspecialchars($_POST["ajouter"]);
@$supprimer =  htmlspecialchars($_POST["supprimer"]);

if (@$supprimer) 
{
delete_link($id_link);
}

if (@$modifier) 
{
modif_link(@$id_link, addslashes(@$title_link), @$id_cat, addslashes(@$link), $id_user);
}

if ($id_link) 
{
$link_unique = link_unique($id_link);
}

if ($ajouter) 
{
$id_article = insert_link(addslashes($title_link), $id_cat, addslashes($link));
}

}

$list_cat = list_cat();
$list_title =  list_title();

?>

<br>

<div class="container">

    <form action="admin.php" method="post" id="target" enctype="multipart/form-data">
          <label for="">Choix du titre</label><br>
            <select name="id_link" id="id_link" onChange="submit()" class="form-control">
              <option value="">Choix du titre*</option>
               <?php foreach ($list_title as $row) 
               { ?>
                <option value="<?php echo @$row->id_link; ?>" <?php if (@$row->id_link == @$_POST["id_link"]) 
                                                                {
                                                                echo " selected";
                                                                } ?>>
                                                                <?php echo $row->title_link; ?>
                </option>
        <?php } ?>
            </select>
            
<label for="">Choix des categories*</label><br>
    <select name="id_cat" id="id_cat" class="form-control" required>
        <option value="">Choix de votre catégorie</option>
        <?php foreach ($list_cat as $row) { ?>
            <option value="<?php echo $row->id_cat; ?>" <?php if ($row->id_cat == @$link_unique->id_cat) {
                                                                echo " selected";
                                                            } ?>><?php echo $row->name_cat; ?></option><?php } ?>
    </select>
    
<label for="">Titre du lien*</label>
<br>
<input type="text" value="<?php echo stripslashes(@$link_unique->title_link); ?>" name="title_link" class="form-control" required>

<label for="">lien*</label>
<br>
<input type="text" value="<?php echo stripslashes(@$link_unique->link); ?>" name="link" class="form-control">
<input type="hidden" name="id_user" class="form-control" value="<?php echo @$_SESSION["id_user"]; ?>" required>
<br>
<?php if (@$id_link) { ?>
<br>
<input type="submit" style="color:rgb(250, 201, 172);" class="btn " name="modifier" value="modifier">
<input type="submit" style="color:rgb(250, 201, 172);" id="supprimer" class="btn" name="supprimer" value="supprimer">
<?php } 
else { ?>
<input type="submit" style="color:rgb(250, 201, 172);" class="btn" name="ajouter" value="Ajouter">
<?php } ?>
</form>
</div>

