<?php

include_once("../classe/connection.class.php");
include_once("../doc.tout/doctout.php");


$pdo= new Connection();
if(isset($_GET['id']) && $_GET['id']=='modify'){
  $modify=true;
  $matricul=$_GET["matricul"];
  $abonner=$pdo->fetch("SELECT prenom FROM inscription where id_userinscri=$matricul");
// print_r($abonner);

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

</head>
<body>
  
<?php 
include_once("../navbar/navbar.php");
?>

<div class="form container">
    <div class="">
      <div class="">
        <h1><?= isset($modify)?"Modifier":"Ajouter"?> un Abonner</h1>
        <form action="../crud/addcrud.php?" method="get" class="m-3"> 
                <div class="form-group">
                    <label for="njd">Prenom Abonner</label>  
                  <input type="text" name="prenom" value="<?= isset($modify)?$abonner['prenom']:""?>" 
                  class="form-control" >           
                     </div>
                <br>
                <button type="submit" class="btn btn-primary"><?= isset($modify)?"Modifier":"Ajouter"?></button>
                <input type="hidden" name="action" value="<?= isset($modify)?"editabonner":"addabonner"?>">
                <input type="hidden" name="matricul" value="<?= isset($modify)?$matricul:""?>">


        </form>
    </div>
</div>
</div>
</body>
</html>