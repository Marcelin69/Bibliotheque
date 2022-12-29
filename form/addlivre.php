<?php

include_once("../classe/connection.class.php");
$pdo= new Connection();
$abonner=$pdo->fetchAll('SELECT * FROM `inscription`');
$emprunt=$pdo->fetchALL("select c.*,(SELECT nom FROM inscription where id_userinscri=c.id_userincri) as nom,(SELECT prenom FROM inscription where id_userinscri=c.id_userincri)as prenom from empruntuser c;");
$userg=$pdo->fetch("SELECT * FROM `inscription`");
$empruntuser=array();
if(isset($_SESSION['user'])){
$session=$_SESSION['user']['id_userinscri'];
$empruntuser=$pdo->fetchALL("select c.*,(select titre from livre where id_livre=c.id_livres) as titre from empruntuser c WHERE 	id_userincri=$session");
}



$mail=(isset($_GET["mail"])?$_GET["mail"]:NULL);

$serch=(isset($_GET["search"])?$_GET["search"]:NULL);
if(isset($serch)){
  $livre=$pdo->fetchALL("SELECT * FROM `livre` WHERE lower(auteur) like '%".strtolower($serch)."%' or lower(titre) like '%".strtolower($serch)."%' ");
  // print("salut");
} else{
  $livre=$pdo->fetchAll("SELECT * FROM livre;");
 }
$prenom=(isset($_GET["prenom"])?$_GET["prenom"]:"");
if(isset($_GET['id']) && $_GET['id']=='modify'){
  $modify=true;
  $matricul=$_GET["matricul"];
  $livre=$pdo->fetch("SELECT `auteur`, `titre` FROM `livre` WHERE id_livre=$matricul");
// print_r($livre);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../disigncss2/style.css">
</head>

<body>
<?php 
include_once("../navbar/navbar.php");

?>
  <div class="form container">
    <div class="">
      <div class="">
<!-- le formulaire d'Ajout et des modification des livres -->
        <h1><?= isset($modify)?"Modifier":"Ajouter"?> un livre</h1><!-- verification du modify -->
        <!-- le message d'erreur-->
        <?php if(isset($_GET["error"]) && isset($_GET["message"])){?>
         <div class="alert res"><?php echo(''.$_GET['message'].'') ?></div>   
        <?php } ?>
        <form action="../crud/addcrud.php" method="post" class="m-3"  enctype="multipart/form-data">
          <div class="form-group">

            <label for="njd">Titre</label>
            <input type="text" name="titre" class="form-control" value="<?= isset($modify)?$livre['titre']:""?>"><!-- modification prée remplit si modify existe -->
          </div>
          <div class="form-group">
            <label for="njd">Auteur</label>
            <input type="text" name="auteur" class="form-control"  value="<?= isset($modify)?$livre['auteur']:""?>"><!-- modification prée remplit si modify existe -->
          </div>
          <div class="form-group">
            <label for="njd">Fichier PDF</label>
            <input type="file" name="fichier" class="form-control"  value="<?= isset($modify)?$livre['auteur']:""?>">
          </div>    
          <br>
          <button type="submit" class="btn btn-primary"><?= isset($modify)?"Modifier":"Ajouter"?></button><!-- button de d'ajour ou de modification -->
          <input type="hidden" name="action" value="<?= isset($modify)?"editlivre":"addlivre"?>">     <!-- action a effectuer pas les function  -->
          <input type="hidden" name="matricul" value="<?= isset($modify)? $matricul:""?>">
          <!--envoir du matricule -->
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