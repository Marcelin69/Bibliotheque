<?php
session_start();
include_once("../classe/connection.class.php");
$pdo= new Connection();
include_once("../doc.tout/doctout.php");


if(isset($_POST['mail'])&& isset($_POST['password'])){
	$mail =htmlspecialchars($_POST['mail']);
	$password =htmlspecialchars($_POST['password']);
  $user=$pdo->fetch("SELECT * FROM `inscription` where mail='$mail' ");
  //cryptage du mot de passe
  $password= "2001.6.4".sha1($password.'(85+45-86)');
 
  // validatio de mail
if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
  header('location:connexion.php?error=1&message=Votre adresse email invalide');
 exit();
}
	

// verification si le mail existe
$req = $pdo->fetch("SELECT COUNT(*) as x FROM inscription WHERE mail='$mail'");
	if($req['x']!=1){
    // <!-- redirection en cas d'erreur -->
		header('location:adduser.php?error=1&message=Inscrivez vous d\'abord ');
		exit();
	}

  
//connexion 
	  $req = $pdo->fetch("SELECT * FROM inscription WHERE mail='$mail'");
    print_r($req);
			if($password == $req['modpass']){  // <!-- verification du mots de passe -->         
				$_SESSION['connect']=1;          // <!-- initiation du session -->
				$_SESSION['mail']=$req['mail'];  // <!-- memorisation du mail dan la SESSION -->
      $_SESSION['user']=$req;           // <!-- verification des donnée est redirection -->
				 header("location:connexion.php?mail='$mail'&success=1&message=Vous êtes bien connecter");
				exit();
			}else{
          // <!-- redirection en cas d'erreur -->
					header('location:connexion.php?error=1&message=Impossible de vous authentifier Verifier vos identifiant');
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
    integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="../disigncss2/style.css">

</head>

<body>
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="../index.php">Bibliothèque</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item active">
            <a class="nav-link offset-4" href="../index.php">Acceuil</a>
          </li>

        </ul>

        <ul class="navbar-nav  my-2 my-lg-0">
          <?php if(isset($_SESSION['connect'])){?>
          <a class="nav-link" href="user/deconnexion.php" tabindex="-1">Deconnexion</a>
          <?php }else{ ?>
          <li class="nav-item active">
            <a class="nav-link" href="adduser.php">Inscription </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="connexion.php">Connexion</a>
          </li>
          <?php } ?>




        </ul>
      </div>
    </div>
  </nav>
  <div class="form container ">
    <div class="">
      <div class=" ">
        <!-- formulaire de connexion -->
        <?php if(isset($_GET["error"]) && isset($_GET["message"])){?>
        <div class="alert res"><?php echo(''.$_GET['message'].'') ?></div>
        <?php }elseif(isset($_SESSION['connect'])){ ?>
        <?php header("location:livreuser.php?mail=$mail")?>
        <?php } ?>
        <form action="?" method="POST">
        <h1>Connexion</h1>
          <div class="form-group">
            <label for="exampleInputEmail1">Mail</label>
            <input type="email" class="form-control" name="mail" id="exampleInputEmail1" aria-describedby="emailHelp"
              placeholder="Enter email" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1"
              placeholder="Password" required><br>
          </div>
          <button type="submit" class="btn btn-primary">Connexion</button>
          <input type="hidden" class="form-control" name="no" <?= isset($mail)?"value='".$mail."'":'' ?>>

          <form action="">
            <a href="../form/modifuser.php"><button class="btn" type="button">Mots de passe oublier</button></a>
          </form>






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