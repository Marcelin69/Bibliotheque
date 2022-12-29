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
include_once("../navbar/navbaruser.php");
?>
<!-- recuperationdes donnée et affichage  -->
  <div class="container-flude">
      <table class="table emprunt">
        <tr class='th' >
          <th>Titre</th>
          <th>Date de sortie</th> 
          <th>Date de rendu</th>
          <th colspan="2" >Action</th>

        </tr>
        <?php foreach($empruntuser as $emprunts):?>
          <tr>
          <td><a  href="<?=$emprunts['files']?>" style="text-decoration:none;" ><?=$emprunts['titre']?></a></td><!-- affiche du titre  -->
          <td><?=$emprunts['date_sortie']?></td><!-- affichage de la date  -->
          <td><?=$emprunts['date_rendu']?></td>
          <td><a href="addempruntuser.php?id=modify&&matricul=<?=$emprunts['id_empruntuser']?>"><button class="btn "><i class="fas fa-edit"></i></a></button></td>
          <!-- button de modification des livres   -->
          <td><a href="#"><button class="btn btn-del" date-id="<?=$emprunts['id_empruntuser']?>"><i class="fas fa-trash"></i></button></a></td>
          <!-- button de suppression des livres  -->
        </tr>
        
      <?php endforeach;?>
      </table>
  </div>
  <script>
  $(document).ready(function () {
    $('.btn-del').click(function(){
      // <!-- message d'alert est de comfirmation  -->
      if(confirm("Etes vous sur de vouloir supprimer l'emprunt")){
        // <!-- redirection   -->
        document.location.href="../crud/addcrud.php?action=delectempruntuser&&id=abonner&&index="+$(this).attr("date-id");
        }
    });

  })
  </script>
   <div class="fin" style="padding-bottom: 150px;">
  
  </div>  
    <?php 
    include_once("../footer/footer.php");

  ?>
    

 
</body>

</html>