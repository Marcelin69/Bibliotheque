
<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="../index.php">Bibliothèque</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Abonnees
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <!-- <li><a class="dropdown-item" href="../form/addabonner.php">Ajouter des Abonnees</a></li> -->
            <li><a class="dropdown-item" href="../admine/abonner.php">Table des Abonnees</a></li>

              <?php foreach($abonner as $abonnees):?>
              <li><a class="dropdown-item" href="#"><?=$abonnees['nom']." ".$abonnees['prenom']?></a></li>
              <?php endforeach;?>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Livre
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="../form/addlivre.php">Ajouter des Livres</a></li>
            <li><a class="dropdown-item" href="../admine/livre.php">Table des Livres</a></li>

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
            <li><a class="dropdown-item" href="../admine/emprunt.php">Table des emprunts</a></li>

            <?php foreach($emprunt as $emprunts):?>
              <li><a class="dropdown-item" href="#"><?=$emprunts['nom']." ".$emprunts['prenom']?></a></li>
              <?php endforeach;?>
            </ul>
          </li>
         
          <li class="nav-item">
            <a class="nav-link" href="../user/deconnexion.php" tabindex="-1" >Deconnexion</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>



 