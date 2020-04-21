<?php

include "sql.php";
include "fonction_blog.php";
include "header.admin.php";

if ($_SESSION["lvl"] != 2) 
{
header('Location: login.php');
}

?>

<?php
////////////////////////////////////////////////////////
////////////////// recup des post /////////////////////
//////////////////////////////////////////////////////
if ($_POST) 
{
@$id_blog = htmlspecialchars($_POST["id_blog"]);
@$id_blog_cat = htmlspecialchars($_POST["id_blog_cat"]);
@$name_blog_cat = htmlspecialchars($_POST["name_blog_cat"]);
@$ajouter =  htmlspecialchars($_POST["ajouter"]);
@$modifier = htmlspecialchars($_POST["modifier"]);
@$supprimer =  htmlspecialchars($_POST["supprimer"]);

if (@$id_blog) 
{
$blog_unique = blog_unique(@$id_blog);
}

if ($ajouter) 
{
$id_blog_cat = insert_blog_cat(addslashes($name_blog_cat));
}
    
if ($supprimer) 
{
delete_blog_cat($id_blog_cat);
}

if ($modifier) 
{
modif_blog_cat(@$name_blog_cat);
}

}

$list_cat = list_cat();

?>



<div class="container">
    <form action="blog_categorie.php" method="post" id="target">
      <label for="">Choix categorie</label><br>
       <select name="id_blog_cat" id="id_blog_cat" onChange="submit()" class="form-control">
        <option value="">choix categorie</option>
           <?php foreach ($list_cat as $row) { ?>
                <option value="<?php echo @$row->id_blog_cat; ?>" <?php if (@$row->id_blog_cat == @$_POST["id_blog_cat"]) {
                                                                        echo " selected";
                                                                    } ?>><?php echo @$row->name_blog_cat; ?></option><?php } ?>
       </select>

       <label for="">nom categorie*</label><br>
        <input type="text" value="<?php echo stripslashes(@$blog_unique->name_blog_cat); ?>" name="name_blog_cat" class="form-control">
         <?php if (@$id_blog_cat) {?>
        <br>
        <input type="submit" class="btn" name="modifier" value="modifier">
        <input type="submit" id="supprimer" class="btn" name="supprimer" value="supprimer">
        <?php } else {?>
        <input type="submit" class="btn" name="ajouter" value="Ajouter">
              <?php } ?>
 </form>
</div>
