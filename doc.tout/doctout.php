<?php
if(!isset($_SESSION)){
  session_start();
  }
  /*Recupeartion des abonner*/
$abonner=$pdo->fetchAll('SELECT * FROM `inscription`');
/*Recuperation des emprnut */
$emprunt=$pdo->fetchALL("select c.*,(SELECT nom FROM inscription where id_userinscri=c.id_userincri) as nom,(SELECT prenom FROM inscription where id_userinscri=c.id_userincri)as prenom from empruntuser c;");
/*Recuperation des donnée de l'utilisateur connecter*/
if(isset($_SESSION['user'])){
$session=$_SESSION['user']['id_userinscri'];
$userg=$pdo->fetch("SELECT * FROM `inscription` WHERE  id_userinscri = $session ");
}
/*Recupration des livres emprunté pas l'utilisateurs connecté*/
$empruntuser=array();
if(isset($_SESSION['user'])){
$session=$_SESSION['user']['id_userinscri'];
$empruntuser=$pdo->fetchALL("select c.*,(select titre from livre where id_livre=c.id_livres) as titre,(select fils_dest from livre where id_livre=c.id_livres) as files from empruntuser c WHERE id_userincri=$session");
}

$mail=(isset($_GET["mail"])?$_GET["mail"]:NULL);

/* Recuperatio,n depuit l'url le livre recherche  */
$serch=(isset($_GET["search"])?$_GET["search"]:NULL);
if(isset($serch)){
  /* recuperation des livres rchercher */
  $livre=$pdo->fetchALL("SELECT * FROM `livre` WHERE lower(auteur) like '%".strtolower($serch)."%' or lower(titre) like '%".strtolower($serch)."%' ");
} else{
  $livre=$pdo->fetchAll("SELECT * FROM livre;");
 }
?>