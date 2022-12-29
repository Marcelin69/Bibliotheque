<?php
session_start();
include_once("classe/connection.class.php");
$pdo= new Connection();
include_once("doc.tout/doctout.php");
$nbrabonne=count($abonner);
$nbrlivre=count($livre);
$nbremprunt=count($emprunt);


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bibliothèque</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
    integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" type="image/pngn" href="image/livre.jpg">
  <link rel="stylesheet" href="disigncss2/style.css">


</head>

<body>
  <header>
    <nav class="navbar fixed navbar-expand-lg bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Bibliothèque</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item active">
              <a class="nav-link offset-4" href="index.php">Acceuil</a>
            </li>
          </ul>
          <ul class="navbar-nav  my-2 my-lg-0">
            <?php if(isset($_SESSION['connect'])){?>
            <?php }else{?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Membre
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php if(isset($_SESSION['admin'])){?>
                <li><a class="dropdown-item" href="admine/abonner.php">Abonner</a></li>
                <?php }else{?>
                <li><a class="dropdown-item" href="admine/connexionadmin.php">connexion</a></li>
                <?php }?>
              </ul>
            </li>
            <?php }?>
            <li class="nav-item dropdown">
              <?php if(isset($_SESSION['admin'])){?>
              <?php }else{?>
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Utilisateurs
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php if(isset($_SESSION['connect'])){?>
                <a class="nav-link offset-4" href="user/livreuser.php">Livre</a>
                <?php }else{?>
                <li class="nav-item active">
                  <a class="nav-link" href="user/adduser.php">Inscription </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="user/connexion.php">Connexion</a>
                </li>
                <?php }?>
                <?php }?>

              </ul>
            </li>
            <!-- <li class="nav-item">
            <?php if(isset($_SESSION['connect'])){ ?>
            <?php }else{?>
            <?php }?>
          </li> -->
          </ul>
        </div>
      </div>
    </nav>
  </header>


  <div class="m-4 position ">
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
          aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
          aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
          aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="image/michel.jpeg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5 class="carousel">Michel Eyquem de Montaigne</h5>
            <p class="carousel-p" style="color:white">Michel Eyquem de Montaigne, seigneur de Montaigne, plus connu sous
              la simple dénomination de Montaigne, né le 28 février 1533 et mort le 13 septembre 1592 au château de
              Saint-Michel-de-Mont…</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="image/victor.jpeg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5 class="carousel" style="color:black">Victor Hugo</h5>
            <p class="carousel" style="color:black">Victor Hugo est un poète, dramaturge, écrivain, romancier et
              dessinateur romantique français, né le 26 février 1802 à Besançon et mort le 22 mai 1885 à Paris.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="image/joseph.jpeg" class="d-block w-100" width="10px" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5 class="carousel" style="color:ffffff">Joseph Hilaire Pierre René Belloc</h5>
            <p class="carousel-p" style="color:white">Joseph Hilaire Pierre René Belloc est un écrivain et historien
              franco-anglais du début du XXe siècle..</p>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

  </div>
  <div>
    <h1 class="h1-card container">Les livre disponible dans notre Bibliothèque</h1>
    <div class="article offset-1" style="display:flex;flex-wrap:wrap;">
      <?php foreach($livre as $livres):?>
      <?php if(isset($_SESSION['connect'])){?>
      <a class="index-a" href="user/livreuser.php">
        <div class="card1" style="display:flex;margin-left:5px
              ;margin-bottom:15px;font-size:15px ">
          <div class="card card2" style="width: 200px; 	height: 150px ; margin-left:10px;">
            <div class="card-body">
              <h5 class="card-title" style="font-size:15px"><strong>Auteur:</strong> <?=$livres['auteur']?></h5>
              <h5 class="card-title" style="font-size:15px"><strong>Titre:</strong><?=$livres['titre']?></h5>
              <h5 class="card-title" style="font-size:15px"><strong class="titre">Date de
                  publication:</strong><?=$livres['date']?></h5>
            </div>
          </div>
        </div>
      </a>
      <?php }?>
      <?php endforeach;?>
      <?php foreach($livre as $livres):?>
      <?php if(empty($_SESSION['connect'])){?>
      <div class="card1" style="display:flex;margin-left:5px;margin-bottom:15px;font-size:15px "> <a class="index-a"
          href="user/connexion.php">
          <div class="card card2" style="width: 200px; 	height: 150px ; margin-left:10px;">
            <div class="card-body">
              <h5 class="card-title" style="font-size:15px"><strong class="auteur">Auteur:</strong>
                <?=$livres['auteur']?></h5>
              <h5 class="card-title" style="font-size:15px"><strong class="titre">Titre:</strong><?=$livres['titre']?>
              </h5>
              <h5 class="card-title" style="font-size:15px"><strong class="titre">Publier le: </strong>
                <?=$livres['date']?></h5>

            </div>
          </div>
        </a>
        <?php }?>
      </div>
      <?php endforeach;?>
    </div>

    <?php if(isset($_SESSION['admin'])){?>

    <div class="">
      <h1 class="" style="text-align: center;">Details du bibliotheque</h1>

    </div>
    <div class="firstcard3 offset-2">


      <div class="card3">
        <div class="card" style="width: 18rem;height:10rem;">
          <div class="card-body">
            <h5 class="card-title livre">Livre emprunter</h5>
            <p class="par"><?= $nbremprunt ?></p>
          </div>
        </div>
      </div>

      <div class="card3">
        <div class="card" style="width: 18rem;  height:10rem;">
          <div class="card-body">
            <h5 class="card-title livre">Abonner</h5>
            <p class="par"><?= $nbrabonne ?></p>
          </div>
        </div>

      </div>
      <div class="card3">
        <div class="card" style="width: 18rem;height:10rem;">
          <div class="card-body">
            <h5 class="card-titl livre">Livre </h5>
            <p class="par"><?= $nbrlivre ?></p>
          </div>
        </div>
      </div>
    </div>
    <?php }?>
    <div class="fin" style="padding-bottom: 100px;">
  
  </div>
    <?php 
 
include_once("footer/footer.php");

 ?>
</body>

</html>