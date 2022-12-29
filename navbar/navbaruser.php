<?php
if(!isset( $_SESSION)){
session_start();
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light bg-primary"  style="color:red">
    <div class="container-fluid">
      <a class="navbar-brand" href="../index.php" >Bibliothèque</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Livre
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="livreuser.php">Table des Livres</a></li>
            <?php foreach($livre as $livres):?>
              <li><a class="dropdown-item" href="#"><?=$livres['titre']?></a></li>
              <?php endforeach;?>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Emprunt
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="empruntuser.php">Table des emprunts</a></li>
            
            <?php foreach($empruntuser as $emprunts):?>
              <li><a class="dropdown-item" href="#"><?=$emprunts['titre']?></a></li>
              <?php endforeach;?>
              <!-- <?php foreach($livre as $livres):?>
              <li><a class="dropdown-item" href="#"><?=$livres['titre']?></a></li>
              <?php endforeach;?> -->
            </ul>
          </li>
         
          <li class="nav-item">
            <a class="nav-link" href="deconnexion.php" tabindex="-1" >Deconnexion</a>
          </li>
          
        </ul>
       <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
           <div class="nav-link ">
           
           <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
               <i class="fas fa-user"></i>
            </a>
            <ul class="dropdown-menu " style="padding: 15px; 	margin-top: 50px;background-color: white;	box-shadow: 5px 5px  15px 5px rgb(0, 0, 0);	border-radius: 5%;  padding:15px;	font-weight: bolder;" aria-labelledby="navbarDropdown">
  
           <li>
                 <u> Vos information</u> <br> 
            </li>
            <li>
           <?= isset($_SESSION['user'])?"<u>Nom :</u> ".$_SESSION['user']['nom']:""  ?>

            </li>
            <?= isset($_SESSION['user'])?" <u>Prenom :</u> ".$_SESSION['user']['prenom']:""  ?>

</li>
            <li>
           <?= isset($_SESSION['user'])? " <u>Tel:</u> ".$_SESSION['user']['numero']:""  ?>
            </li>
            <li>
           <?= isset($_SESSION['user'])? " <u>Age: </u>".$_SESSION['user']['age']."ans":""  ?>
            </li>
            <li>
           <?= isset($_SESSION['user'])? $_SESSION['user']['mail']."":""  ?>
            </li>
            <li>
           <?= isset($_SESSION['user'])?" <u>Inscrit le:</u> ".$_SESSION['user']['date']."":""  ?>

            </li>

            <li >
            <a  href="deconnexion.php" tabindex="-1" >Deconnexion</a>
          </li>

            </ul>
          </li>
    
           
          
            
       </ul>
       <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
 
  
  