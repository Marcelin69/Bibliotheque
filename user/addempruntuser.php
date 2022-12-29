<?php

include_once("../classe/connection.class.php");
$pdo= new Connection();
include_once("../doc.tout/doctout.php");



// $prenom=(isset($_GET["prenom"])?$_GET["prenom"]:"");

// recuperation des donnée du base de donnée
$abonner=$pdo->fetchAll('SELECT * FROM abonnes');
$livre=$pdo->fetchAll("SELECT * FROM livre;");
// recuperation des donnée du url
if(isset($_GET['matriculuse']) ){
  $matriculuser=$_GET["matriculuse"];
}

if(isset($_GET['id']) && $_GET['id']=='modify'){
  $modify=true;
  $matricul=$_GET["matricul"];
   $empruntuse=$pdo->fetch("SELECT * FROM `empruntuser` WHERE id_empruntuser=$matricul");
  
}elseif(isset($_GET['id']) && $_GET['id']=='add'){
  $ajour=true;
  $matricul=$_GET["matricul"];
  $doc=$pdo->fetch("SELECT * FROM livre WHERE  id_livre=$matricul");

}


$mail=(isset($_GET["mail"])?$_GET["mail"]:NULL);
$user=$pdo->fetch("SELECT * FROM `inscription` WHERE mail=$mail ");

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" href="../disigncss2/style.css">
</head>

<body>
<?php 
include_once("../navbar/navbaruser.php");
?>
  <div class="form container">
    <div class="">
      <div class="">
        <!-- formullaire d'ajour et de modification -->
        <h1><?= isset($modify)?"Modifier":"Emprunter"?> un livre</h1><!--vrification d'existance de modif-->
        <!--Affichage de message d'erreur-->
        <?php if(isset($_GET["error"]) && isset($_GET["message"])){?>
         <div class="alert res"><?php echo(''.$_GET['message'].'') ?></div>   
        <?php } ?>
        <form action="../crud/addcrud.php" method="POST" class="m-3">
          <div class="form-group">
          <div class="form-group">
            <label for="njd">Titre livre</label>
            <select class="form-control" name="id_livre" id="<?=isset($ajour)?$doc['id_livre']:$livres['id_livre']?>"  >
            <?php foreach($livre as $livres):?><!--recuperation des donnée et affichage-->
           <option value="<?=isset($ajour)?$doc['id_livre']:$livres['id_livre']?>"
                <?= (isset($modify) && $livres['id_livre']== $empruntuse['id_livres'])?"selected":'' ?>
                 ><?=isset($ajour)?$doc['titre']." : ".$doc['auteur']:$livres['titre']." : ".$livres['auteur']?></option>
              <?php endforeach;?><!--Affichage des livres pour la selection-->
            </select>
          </div>
          <div class="form-group">

            <label for="njd">Date de sortie</label>
            <input type="date" name="dates" class="form-control" value="<?=isset($modify)? $empruntuse['date_sortie']:""?>" required><!--prée remplissement des dates si le modify exite-->
          </div>
          <div class="form-group">

            <label for="njd">Date de rendu</label>
            <input type="date" name="dater" class="form-control" value="<?= isset($modify)? $empruntuse['date_rendu']:""?>"><!--prée remplissement des dates si le modify exite-->
            
          </div>
          <br>
          <button type="submit" class="btn btn-primary"><?= isset($modify)?"Modifier":"Ajouter"?></button>
          <input type="hidden" name="action" value="<?= isset($modify)?"editempruntuser":"addempruntuser"?>"><!--envoir de l'action a effectuer par le fonction-->
          <input type="hidden" name="matricul" value="<?= isset($modify)? $matricul:$matriculuser?>">
<!--envoir de l'identifiant du l'utilisateur-->
        </form>
      </div>
    </div>
  </div>
  </div>
  <div class="fin" style="padding-bottom: 350px;">
  
  </div>
  <?php 

include_once("../footer/footer.php");

 ?> 
</body>

</html>