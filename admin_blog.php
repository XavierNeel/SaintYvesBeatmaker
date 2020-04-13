<?php
include "header.admin.php";
include "sql.php";
include "fonction_blog.php";
include "upload.php";


?>
<?php

if ($_SESSION["lvl"] != 2) {
    header('Location: login.php');
}

if ($_POST) {

    @$id_blog = htmlspecialchars($_POST["id_blog"]);
    @$title_blog = htmlspecialchars($_POST["title_blog"]);
    @$display =  htmlspecialchars($_POST["display"]);
    @$blog =  htmlspecialchars($_POST["blog"]);
    @$id_blog_cat = htmlspecialchars($_POST["id_blog_cat"]);
    @$view =  htmlspecialchars($_POST["view"]);
    @$tags = htmlspecialchars($_POST["tags"]);
    @$img  =  $_FILES;
    @$id_user = htmlspecialchars($_POST["id_user"]);
    @$modifier = htmlspecialchars($_POST["modifier"]);
    @$name_blog_cat = htmlspecialchars($_POST["name_blog_cat"]);
    @$ajouter =  htmlspecialchars($_POST["ajouter"]);
    @$supprimer =  htmlspecialchars($_POST["supprimer"]);
    @$modifier =  htmlspecialchars($_POST["modifier"]);






    if (@$supprimer) {
        delete_blog($id_blog);
    }

    if (@$modifier) {
        modif_blog($id_blog, $title_blog, $display, $blog, $id_blog_cat, $view, $tags, $img, $id_user);
    }

    if ($id_blog) {
        $blog_unique = blog_unique($id_blog);
    }

    if ($ajouter) {
        $id_blog = insert_blog(addslashes($title_blog),  addslashes($display), addslashes($blog), $id_blog_cat, @$view, $tags, $img, $id_user);
    }
}

$list_blog_cat = list_cat();
$list_title =  list_title();

?>


<div class="container">

    <form action="admin_blog.php" method="post" id="target" enctype="multipart/form-data">
        <label for="">titre du blog</label><br>
        <select name="id_blog" id="id_blog" onChange="submit()" class="form-control">
            <option value="">Choix du blog</option>

            <?php foreach ($list_title as $row) { ?>
                <option value="<?php echo @$row->id_blog; ?>" <?php if (@$row->id_blog == @$_POST["id_blog"]) {
                                                                    echo " selected";
                                                                } ?>><?php echo $row->title_blog; ?></option>
            <?php } ?>

        </select>


        <!-- LISTE CATEGORIES -->
        <label for="">Choix des categories*</label><br>
        <select name="id_blog_cat" id="id_blog_cat" class="form-control" required>
            <option value="">Choix de votre catégorie</option>
            <?php foreach ($list_blog_cat as $row) { ?>
                <option value="<?php echo $row->id_blog_cat; ?>" <?php if ($row->id_blog_cat == @$blog_unique->id_blog_cat) {
                                                                        echo " selected";
                                                                    } ?>><?php echo $row->name_blog_cat; ?></option>
            <?php } ?>
        </select>


        <input type="hidden" name="id_user" class="form-control" value="<?php echo @$_SESSION["id_user"]; ?>" required><br>
        <label for="">titre du blog*</label><br>
        <input type="text" value="<?php echo stripslashes(@$blog_unique->title_blog); ?>" name="title_blog" class="form-control" required>
        <label for="">presentation*</label><br>
        <textarea name="display" id="display" class="form-control" rows="5" cols="30"><?php echo stripslashes(@$blog_unique->display) ?></textarea><br>

        <label for="">blog*</label><br>

        <textarea name="blog" id="blog" class="form-control" cols="30" rows="10"><?php echo stripslashes(@$blog_unique->blog) ?></textarea>

        <?php
        echo (@$blog_unique->view);
        if (@$blog_unique->view == "" || @$blog_unique->view == 1) {
            @$checked1 = " checked ";
        } else {
            @$checked2 = " checked ";
        }
        ?>
        <label for="">tags</label><br>
        <input type="text" class="form-control" value="<?php echo @$blog_unique->tags ?>" name="tags">
        <br>

        <div class="afficher">
            <label for="">voulez vous afficher ce blog?</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" <?php echo @$checked1 ?> name="view" id="inlineRadio1" value="1">
                <label class="form-check-label" for="inlineRadio1">oui</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" <?php echo @$checked2 ?> name="view" id="inlineRadio2" value="0">
                <label class="form-check-label" for="inlineRadio2">non</label>
            </div>
        </div>
        <br>


        <input type="hidden" name="id_user" class="form-control" value="<?php echo @$_SESSION["id_user"]; ?>" required><br>

        <div class="image">
            <input type="file" name="image"><br><br>
            <img width="300px" src="upload/<?php echo @$blog_unique->img; ?>" alt=""><br>
            <?php echo @$blog_unique->img; ?>
        </div>

        <?php if (@$id_blog) { ?><br>

            <input type="submit" class="btn" name="modifier" value="modifier">
            <input type="submit" id="supprimer" class="btn" name="supprimer" value="supprimer">
        <?php } else { ?>
            <input type="submit" class="btn" name="ajouter" value="Ajouter">

        <?php } ?>



    </form>
</div>




