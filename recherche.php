<?php
include "sql.php";
include "fonction_blog.php";


?>

<?php
if ($_POST) 
{
@$search = htmlspecialchars($_POST["search"]);
@$result = search($search);
}

?>

<?php include "header.php"; ?>
   <div class="recherche">
<?php
    if (!empty($result)) { ?>
<div class="hi">
            <?php foreach ($result as $row) { ?>
                <img height="300px" src="upload/<?php echo @$row->img; ?>" alt="" class="card-img-top" alt="...">
                <h5 class="card-title"><?php echo stripslashes($row->title_blog) ?></h5>
                <p class="card-text"><?php echo stripslashes($row->display) ?>...</p>
                <a href="#" class="card-link"><a href="blog.php?id=<?php echo $row->id_blog; ?>&nom_cat=">suite</a></a>
            <?php  } ?>
        </div>
    <?php } else {
        echo "mot manquant";
    ?>
    <?php } ?>
</div>

<script>
    $(document).ready(function() {
        $(".hi").mark("<?php echo @$search; ?>");
    });
</script>


<?php include "footer.php"; ?>