<?php ob_start(); ?>
<?php $unique = uniqid(); ?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="site officiel de Saintyves Beatmaker, création musical"> <!-- Meta Description -->
    <link rel="stylesheet" type="text/css" href="./slick/slick.css">
    <link rel="stylesheet" type="text/css" href="./slick/slick-theme.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css?un=<?php echo $unique; ?>">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script type="text/javascript" id="cookieinfo" src="//cookieinfoscript.com/js/cookieinfo.min.js">
</script>

    <title>SY Beatmaker</title>
</head>

  
<header> 
<div class="nav">
<img class="logo" src="photo/sybeatmaker.jpg" alt="banniere">
<ul class="menu">
<li><a class="nav-link " style="color:black;" href="index.php">Accueil</a></li>
<li><a class="nav-link" style="color:black;" href="login.php" target="_blank" rel="noopener">Login</a></li>
<li><a class="nav-link" style="color:black;" href="enregistrement.php" target="_blank" rel="noopener">Enregistrement</a></li>
<li><a class="nav-link" style="color:black;" href="blog.php" target="_blank" rel="noopener">blog</a></li>
<li><button type="button" class="btn" data-toggle="modal" data-target="#exampleModal">
  contact
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">me contacter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       xavierneel@gmail.com
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</li>
</ul>
</div>  
<div>
<div class="res">reseaux sociaux</div> 
<ul class="lien">
  <li><a href="https://www.youtube.com/channel/UCO8F6et9nPeQ3pI0RzAywCA"><img src="photo/youtube.png" style="width:50px;" alt="youtube"></a></li>
  <li><a href="https://www.instagram.com/saintyvesbeatmaker/"><img src="photo/insta.png" style="width:50px;" alt="instagram"></a></li>
  <li><a href="https://www.facebook.com/saintyvesbeatmaker/"><img src="photo/facebook.png" style="width:50px;" alt="facebook"></a></li>
  <li><a href="https://soundcloud.com/saintyvesbeatmaker/tracks"><img src="photo/soundcloud.png" style="width:50px;" alt="soundcloud"></a></li> 
  <li><a href="https://saintyves.bandcamp.com/"><img src="photo/bandcamp.png" style="width:50px;" alt="bandcamp" /></a></li> 
</ul>
</div>

<form class="form-inline my-2 my-lg-0" method="POST" action="recherche.php">
   <input id="recherche" class="form-control mr-sm-2" name="search" value="<?php echo (@$result->search) ?>" type="search" placeholder="Search">
   <input id="photo" type="image" src="photo/loupe.png" style="width:50px;" alt="recherche" class="btn" name="search">
</form>

</header>
<body>
