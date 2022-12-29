<?php
session_start();
include_once("../classe/connection.class.php");
$pdo= new Connection();
include_once("../doc.tout/doctout.php");


// veriffication des données existante

if(isset($_POST['identifiant']) && isset( $_POST['modif'])){
  $modif=htmlspecialchars($_POST['modif']);
	$identifiant=htmlspecialchars($_POST['identifiant']);
  $user=$pdo->fetch("SELECT * FROM `inscription` where mail='$mail' ");

//verification de mail
$req = $pdo->fetch("SELECT COUNT(*) as x FROM inscription WHERE mail='$identifiant'");

	if($req['x']!=1){
		 header('location:modifuser.php?error=1&message=le mail n\'existe pas');
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
          <?php if(isset($_SESSION['admin'])){?>
          <a class="nav-link" href="../user/deconnexion.php" tabindex="-1">Deconnexion</a>
          <?php }else{ ?>
          <li class="nav-item active">
            <!-- <a class="nav-link" href="adduser.php">Inscription </a> -->
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../user/connexion.php">Connexion</a>
          </li>
          <?php } ?>




        </ul>
      </div>
    </div>
  </nav>

  <?php 
  
  // print_r( $identifiant);
  
  if(isset($modif)){ ?>
 <!-- formulair de modification de mots de passe  user -->
    <div class="form container ">
    <div class="">
      <div class=" ">
        <!-- afichacge de message d'eurreur ou de susser  -->
        <?php if(isset($_GET["error"]) && isset($_GET["message"])){?>
        <div class="alert res"><?php echo(''.$_GET['message'].'') ?></div>
        <?php }elseif(isset($_SESSION['admin'])){ ?>
        <?php header("location:abonner.php?mail=$mail")?>
        <?php } ?>
        <form action="../crud/addcrud.php" method="POST">
          <div class="form-group">
             <!-- nouveau mot de passe  -->

            <label for="exampleInputEmail1">Nouveau mot de passe</label>
            <input type="password" class="form-control" name="npasse" id="exampleInputEmail1"
              aria-describedby="emailHelp" placeholder="Nouveau mot de passe">
          </div>
         <div class="form-group">
             <!-- confirmation du nouveau mot de passe  -->

            <label for="exampleInputEmail1">Confimer le mot de passe</label>
            <input type="password" class="form-control" name="npasse1" id="exampleInputEmail1"
              aria-describedby="emailHelp" placeholder="Confimer le mot de passe">
          </div>
         <br>
          <button type="submit" class="btn btn-primary">Submit</button>
          <input type="hidden" class="form-control" name="matricul" value="<?= isset($modif)? $identifiant :'' ?>"> 
          <input type="hidden" class="form-control" name="action" value="passworduser">  

        </form>
      </div>
    </div>
  </div>
       <?php  }else{?>
        <div class="form container ">
    <div class="">
      <div class=" ">
        <!-- afichacge de message d'eurreur ou de susser  -->
        <?php if(isset($_GET["error"]) && isset($_GET["message"])){?>
        <div class="alert res"><?php echo(''.$_GET['message'].'') ?></div>
        <?php }elseif(isset($_SESSION['admin'])){ ?>
        <?php header("location:abonner.php?mail=$mail")?>
        <?php } ?>
        <form action="?" method="POST">
          <div class="form-group">
            <label for="exampleInputEmail1">Mail</label>
            <input type="text" class="form-control" name="identifiant" id="exampleInputEmail1"
              aria-describedby="emailHelp" placeholder="Enter email">
          </div>
         <br>
          <button type="submit" class="btn btn-primary">Submit</button>
          <input type="hidden" class="form-control" name="no" <?= isset($mail)?"value='".$mail."'":'' ?>>  
          <input type="hidden" class="form-control" name="modif" value="modifier"> 
        </form>
      </div>
    </div>
  </div>
  <div class="fin" style="padding-bottom: 350px;">
  
  </div>
        
    <?php   } ?>


  <div class="footer2">
    <?php 
include_once("../footer/footer.php");

 ?>
  </div>
</body>

</html>