<?php ob_start(); ?>

<?php


@$menu = $_GET["menu"];

switch ($menu) {
    case 1:
        $active_1 = "active";
        break;
    case 2:
        $active_2 = "active";
        break;
    default:
        $active_1 = "active";
        break;
}
$unique = uniqid();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="./slick/slick.css">
    <link rel="stylesheet" type="text/css" href="./slick/slick-theme.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/style.css?un=<?php echo $unique; ?>">

    <title>SY Beatmaker</title>
</head>

<body>






    <nav class="navbar navbar-expand-lg navbar-light sticky" style="background-color:rgb(223, 93, 46)  ;">
        <div class=logo><img src="photo/sybeatmaker.jpg" width="100px" height="100px" alt="icone"></div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a class="nav-link" style="color:black;" href="blog_categorie.php">Categorie<span class="sr-only">(current)</span></a>
                <li class="nav-item ">
                    <a class="nav-link" style="color:black;" href="admin_blog.php">Retour<span class="sr-only">(current)</span></a>
                <li class="nav-item ">
                    <a class="nav-link" style="color:black;" href="index.php">retour accueil<span class="sr-only">(current)</span></a>
                <li class="nav-item <?php echo @$active_1 ?>">
                    <a class="nav-link" style="color:black;"href="admin.php?menu=1">Admin <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item <?php echo @$active_2 ?>">
                    <a class="nav-link" style="color:black;" href="moderateur.php?menu=2">Moderation<span class="sr-only">(current)</span></a>
                </li>



            </ul>

        </div>
    </nav>