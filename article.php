<?php

include "sql.php";
include "fonction_blog.php";
include "header.php";

?>

<?php

$list_cat = list_cat();
$list_title =  list_title();
@$id_blog = $_GET["id"];
@$id_user = htmlspecialchars($_POST["id_user"]);
@$id_view = htmlspecialchars($_POST["id_view"]);
@$ajouter = htmlspecialchars($_POST["ajouter"]);
@$modifier = htmlspecialchars($_POST["modifier"]);
@$supprimer = htmlspecialchars($_POST["supprimer"]);
@$view = htmlspecialchars($_POST["view"]);


if ($ajouter) 
{
insert_view($id_blog, $view);
}

$blog_unique = blog_unique($id_blog);
$recup_view = listview($id_blog);
?>

<div class="image">
    <img src="upload/<?php echo @$blog_unique->img ?>" alt=""><br>
</div>

<div class="jumbotron">
    <h1 class="titre"><?php echo stripslashes($blog_unique->title_blog) ?></h1>
    <p class="blog"><?php echo stripslashes($blog_unique->blog) ?></p>
    <hr class="name">
    <p><?php echo $blog_unique->lastname ?> <?php echo $blog_unique->firstname ?></p>
    <button type="submit" id="comment" class="fas fa-comments" data-toggle="modal" data-target="#exampleModal1" name="laissez un commentaire" value="laissez un commentaire">laissez un commentaire</button>
    <button type="submit" id="avis" class="far fa-eye " data-toggle="modal" data-target="#exampleModal2" name="voir avis" value="voir avis">avis</button>
</div>

<?php include "footer.php"; ?>
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if ($blog_unique->view) { ?>
                <?php foreach ($recup_view as $row) { ?>
                    <div class="card-body x">
                        <h5 class="card-title"> <?php echo @$row->login ?>:<?php '..' ?> <?php echo @$row->view ?></h5>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    


<?php if ($blog_unique->view) { ?>
    <form action="article.php?id=<?php echo $id_blog; ?>" method="post">
        <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ajouter votre commentaire</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <textarea name="view" maxlength="300" id="view" class="form-control" cols="30" rows="5"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="add" class="far fa-eye" name="ajouter" value="Ajouter">envoyer votre commentaire</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php } ?>