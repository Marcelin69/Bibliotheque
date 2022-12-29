<?php
session_start();
if(isset($_SESSION['connect'])){ 
	header('location:connexion.php?');
 } 
include_once("../classe/connection.class.php");
$pdo= new Connection();
include_once("../doc.tout/doctout.php");

if(isset($_POST['nom'])&&isset($_POST['prenom'])&&isset($_POST['mail'])&&isset($_POST['password'])&&isset($_POST['password2'])){
// reception des donnée du URL et sauvegarder des les variable
$nom=(isset($_POST['nom'])?$_POST['nom']:'');
$prenom=(isset($_POST['prenom'])?$_POST['prenom']:'');
$number=(isset($_POST['numero'])?$_POST['numero']:'');
$age=(isset($_POST['age'])?$_POST['age']:'');
$mail=(isset($_POST['mail'])?$_POST['mail']:'');
$password=(isset($_POST['password'])?$_POST['password']:'');
$password2=(isset($_POST['password2'])?$_POST['password2']:'');

if(strlen($password)<8){
  header('location:adduser.php?error=1&message= votre mots de passe est faible');
  exit();
}

$res=$pdo->fetch("SELECT COUNT(*) as x FROM  inscription WHERE mail='$mail'");
$cle= sha1($mail).time();
$cle=sha1($cle).time().time();
// cryptage du mot de passe
$password= "2001.6.4".sha1($password.'(85+45-86)');
 $password2= "2001.6.4".sha1($password2.'(85+45-86)');
//  verification du comfimation du mot de passe  du mail ,si le mail est deja utilisaer et envoir de donnée la base de donnee 
if($password!=$password2){
  header('location:adduser.php?error=1&&message=vos mots de passe sont diférant');
}elseif(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
  header('location:adduser.php?error=1&message=Votre adresse email est invalide');
  exit();
 }elseif($res['x']!=0){
		header('location:adduser.php?error=1&message=Adresse mail déjà utiliser');
		exit();
	}else{
    $pdo->execute("INSERT INTO `inscription`(`nom`, `prenom`, `numero`, `age`, `mail`, `modpass`, `secret`) VALUES ('$nom','$prenom','$number','$age','$mail','$password','$cle')");
    
    $pdo->execute("INSERT INTO `abonnes`(`nom`, `prenom`) VALUES ('$nom','$prenom')");

 header('location:connexion.php?sucesse=1&message=Vous êtes bien inscrit');
 exit();
  }
 
 

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
 <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" href="../disigncss2/style.css">


</head>

<body>
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
  <a class="navbar-brand" href="../index.php">Bibliothèque</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item active">
        <a class="nav-link offset-4" href="../index.php" >Acceuil</a>
      </li>
        
      </ul>
      <ul class="navbar-nav  my-2 my-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="adduser.php">Inscription </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="connexion.php">Connexion</a>
      </li>
     
    </ul>
    </div>
  </div>
</nav>

  <div class="form container ">
  <div class="">
      <div class=" ">
        <!-- formulaire d'inscription -->
        <form   method="post" >
        <h1>Inscription</h1>
          <!--Afiichage de message d'erreur-->
        <?php if(isset($_GET['error']) && isset($_GET['message'])){ ?>
         <div class="alert res"><?php  echo($_GET['message'])  ?></div>
       <?php }elseif(isset($_GET["sucesse"])&& isset($_GET["message"])){ ?>
         <div class="alert ret"> <?php  echo($_GET['message'])  ?></div>
        <?php }?>
          <div class="form-group">
            <label for="exampleInputEmail1">Nom</label>
            <input type="text" class="form-control " name="nom" id="exampleInputEmail1" aria-describedby="emailHelp"
              placeholder="Enter nom" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Prenom</label>
            <input type="text" class="form-control"name="prenom" id="exampleInputEmail1" aria-describedby="emailHelp"
              placeholder="Enter Prenom" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Numer Tel</label>
            <input type="number" class="form-control" name="numero" id="exampleInputEmail1" aria-describedby="emailHelp"
              placeholder="Enter votre numero" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Âge</label>
            <input type="number" class="form-control"name="age" id="exampleInputEmail1" aria-describedby="emailHelp"
              placeholder="Enter votre age" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Mail</label>
            <input type="email" class="form-control" name="mail" id="exampleInputEmail1" aria-describedby="emailHelp"
              placeholder="Enter email" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password" required>
          </div>
          <div class="form-group mb-2">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="password2" id="exampleInputPassword1" placeholder="Password" required><br>
          </div>
          <button type="submit" class="btn btn-primary">Inscription</button>
        </form>

      </div>
    </div>
  </div>
  
  <div class="fin" style="padding-bottom: 350px;">
  
  </div>
 
 <div class="footer2">
 <?php 
include_once("../footer/footer.php");

 ?>
 </div>
</body>

</html>