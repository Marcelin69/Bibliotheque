<?php


include_once("../classe/connection.class.php");
$pdo= new Connection();
include_once("../doc.tout/doctout.php");

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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" defert></script>
  <link rel="stylesheet" href="../disigncss2/style.css">
</head>

<body>
<?php 
include_once("../navbar/navbar.php");
?>
<!-- recuperation et affichage des emprunt  -->

  <div class="container-flud">
  <div class="marg">
    <div class="col-12">
      <table class="table">
        <tr class="th">
          <th>id</th>
          <th>livre</th>
          <th>Date sortie</th> 
          <th>Date rendu</th>
          <th >Action</th>

        </tr>
        <?php foreach($emprunt as $emprunts):?>
          <tr>
          <td><?=$emprunts['id_userincri']?></td>
          <td><?=$emprunts['id_livres']?></td>
          <td><?=$emprunts['date_sortie']?></td>
          <td><?=$emprunts['date_rendu']?></td>
          <td><a href="../form/addempruntuser.php?id=modify&&matricul=<?=$emprunts['id_empruntuser']?>">
          <button class="btn "><i class="fas fa-edit"></i></a></button><a href="#"><button class="btn btn-del" date-id="<?=$emprunts['id_empruntuser']?>">
          <i class="fas fa-trash"></i></button></a></td>
        </tr>
        
      <?php endforeach;?>
      </table>
    </div>
  </div>
  </div>
  <script>
  $(document).ready(function () {
    $('.btn-del').click(function(){
      if(confirm("Etes vous sur de vouloir supprimer l'emprunt")){
        document.location.href="../crud/addcrud.php?action=delectemprunt&&id=abonner&&index="+$(this).attr("date-id");
        }
    });

  })
  </script>
   <div class="fin" style="padding-bottom: 350px;">
  
  </div>
<div class="footer2">
<?php 
include_once("../footer/footer.php");

 ?>
</body>

</html>