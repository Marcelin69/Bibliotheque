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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" defert></script>
  <link rel="stylesheet" href="../disigncss2/style.css">

</head>

<body>

  <?php 
include_once("../navbar/navbaruser.php");
?>
<!-- recuperationdes donnée et affichage  -->

  <div class="container-flude">
    <h1 class="livre-h1">Les livres disponible dans la Bibliothèque</h1>
    <div class="marg" >
    <div class="col-12">
      <table class="table">
        <tr class="th">
          <th>Auteur</th>
          <th>Titre</th>
          <?php if(isset($userg)){?>      
          <th>Action</th>
          <?php }?>

        </tr>

        <?php foreach($livre as $livres):?>
        <tr>
          <td><?=$livres['auteur']?></td>
          <td><a  href="<?=$livres['fils_dest']?>" style="text-decoration:none;" ><?=$livres['titre']?></a></td>
          <?php if(isset($userg)){?>      
          <td><a
              href="addempruntuser.php?id=add&&matricul=<?=$livres['id_livre']?>&&matriculuse=<?=$userg['id_userinscri']?>"><button
                class="btn "><i class="fas fa-shopping-bag"></i></a></button></td>
       
          <?php }?>
        </tr>
        <?php endforeach;?>
      </table>
    </div>
  </div>
  <script>
  $(document).ready(function() {
    $('.btn-del').click(function() {
      if (confirm("Etes vous sur de vouloir supprimer le livre ?")) {
        document.location.href = "addcrud.php?action=delectlivre&&id=abonner&&index=" + $(this).attr("date-id");
      } else {}
    });

  })
  </script>
   <div class="fin" style="padding-bottom: 100px;">
  
  </div>
<?php 
include_once("../footer/footer.php");

 ?>
</body>

</html>