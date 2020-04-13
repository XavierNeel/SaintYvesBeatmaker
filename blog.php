<?php
include "sql.php";
include "fonction_blog.php";
include "header.php";
?>

<?php
@$id_blog = htmlspecialchars($_POST["id_blog"]);
$recup_blog = recup_blog();




// var_dump($recup_des_articles);
?>









<div class="blog">


    <?php foreach ($recup_blog as $row) { ?>
        <div class="card a">
            <img class="card-img-top" src="upload/<?php echo $row->img; ?>" alt="Card image cap">
            <div class="card-body">
                <p class="card-text"><?php echo stripslashes($row->title_blog) ?></p>
                <p class="card-text"><?php echo stripslashes($row->display) ?></p>
                <a href="article.php?id=<?php echo $row->id_blog; ?>&nom_cat=" class="btn">voir article</a>

            </div>
        </div>
    <?php } ?>
</div>
<!-- <div class="card-deck">
  <div class="card">
    <img src="upload/<?php echo $row->img; ?>" class="card-img-top" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title"><?php echo stripslashes($row->title_blog) ?></h5>
      <p class="card-text"><?php echo stripslashes($row->display) ?></p>
      <p class="card-text"><small class="text-muted"><a href="article.php?id=<?php echo $row->id_blog; ?>&nom_cat=" class="btn">voir article</a></small></p>
    </div>
  </div> -->
 
 
</div>

<?php include "footer.php" ?>