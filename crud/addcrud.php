<?php
session_start();
// if(isset($_POST["action"])){
//     echo('salut');
// }
include_once("../classe/connection.class.php");
$pdo= new Connection();
if(isset($_POST["action"])){
  // la function switch qui permet a choisir l'action a effectuer
    switch($_POST["action"]){
      case "addabonner":
        addabonner();
        break;
        case "addlivre":
            addlivre();
          break;
          case "addempruntuser":
            addempruntuser();
          break;
          case "addemprunt":
            addemprunt();
            break;
            case "editabonner":
               editabonner();
              break;
              case "editlivre":
                editlivre();
               break;
               case "editempruntuser":
                editempruntuser();
                break;
                case "editemprunt":
                  editemprunt();
                  break;
                case "delectabonner":
                    delectabonner();
                  break;
                  case "delectlivre":
                    delectlivre();
                  break;
                    case "delectempruntuser":
                      delectempruntuser();
                    break;
                    case "delectemprunt":
                      delectemprunt();
                  break;
                  case "password":
                    password();
                break;
                case "passworduser":
                  passworduser();
              break;
              case "passwordadmin":
                passwordamin();
            break;
                
                    
    }
  
  }
  
  if(isset($_GET["action"])){
    switch($_GET["action"]){  
                case "delectabonner":
                    delectabonner();
                  break;
                  case "delectlivre":
                    delectlivre();
                  break;
                    case "delectempruntuser":
                      delectempruntuser();
                    break;
                    case "delectemprunt":
                      delectemprunt();
                  break;
                    
    }
  
  }
  
  //ajour des donners a la base de donners 
  function addabonner(){
    global $pdo;
    $prenom=(isset($_POST["prenom"])?$_POST["prenom"]:"");
    header("location:../index.php");
  }
  // la function addlivre ajoute des l'livres a la base de donners 
  function addlivre(){   
    global $pdo;
    if(!empty($_FILES)){
      $file_name=$_FILES['fichier']['name'];//recuperation des donnée nom du fichier
      $file_extension=strrchr($file_name,'.'); //recuperation des donnée extention 
      $file_extension_autorise=array('.pdf','.PDF'); //recuperation des donnée type
      $file_tmp=$_FILES['fichier']['tmp_name']; 
      $file_dest='../fichierpdf/'.$file_name;
      if(in_array($file_extension,$file_extension_autorise)){ //verification des extention
        if(move_uploaded_file($file_tmp,$file_dest)){
          $titre=(isset($_POST["titre"])?$_POST["titre"]:"");//recuperation des donnée titre 
          $auteur=(isset($_POST["auteur"])?$_POST["auteur"]:""); //recuperation des donnée auteur
          $pdo->execute("INSERT INTO `livre`( `auteur`, `titre`,`fils_name`, `fils_dest`) VALUES ('$auteur','$titre','$file_name','$file_dest')"); //envoir de livre dans la base de donnée
     header("location:../admine/livre.php?susser=1&&message=Livre ajouter avec susser");
     //redirection avec message de susser au cas ou le livre 
        }
      }else if($_FILES['fichier']['error']==true){
        header('location:../form/addlivre.php?error=1&message=Verifier votre fichier PDF');
        //redirection avec message d'erreurs au cas ou il y a des erreur 
      }else{
        header('location:../form/addlivre.php?error=1&message=Votre fichier n\'est pas PDF');
        //redirection avec message d'erreurs au cas ou il y a des erreur 
      }
      
    }

     
  
  }
    // la function addemprunteuser ajoute des l'livres emprunter par l'utilisate a la base de donners 
  function addempruntuser(){
    global $pdo;
    $livre=(isset($_POST["id_livre"])?$_POST["id_livre"]:"");
    $dates=(isset($_POST["dates"])?$_POST["dates"]:"");
    $dater=(empty($_POST["dater"])?"NULL":"'".$_POST['dater']."'");
    $matricule=(isset($_POST["matricul"])?$_POST["matricul"]:""); 
    if($dates < date("Y-m-d ") || $dater < date("Y-m-d ")) {
      header("location:../user/addempruntuser.php?error=1&message=votre date entrez n'est pas correct & matriculuse=$matricule");
    }else{
      $pdo->execute("INSERT INTO `empruntuser`(`id_livres`, `id_userincri`, `date_sortie`, `date_rendu`) VALUES ('$livre','$matricule','$dates',$dater)");
      header("location:../user/empruntuser.php");
    } 
    
  }
    // la function addemprunt ajoute emprunt des l'livres a la base de donners 
  function addemprunt(){
    global $pdo;
    $abonne=(isset($_POST["id_abonne"])?$_POST["id_abonne"]:"");
    $livre=(isset($_POST["id_livre"])?$_POST["id_livre"]:"");
    $dates=(isset($_POST["dates"])?$_POST["dates"]:"");
    $dater=(empty($_POST["dater"])?"NULL":"'".$_POST['dater']."'");
    $pdo->execute("INSERT INTO `emprunt`(`id_abonnes`, `id_livres`, `date_sortie`, `date_rendu`) VALUES ('$abonne','$livre','$dates',$dater)");
    // header("location:../emprunt.php");
  }
  
// Modifiecation des donner de la base de donner 
  function  editabonner(){
    global $pdo;
    $prenom=(isset($_POST["prenom"])?$_POST["prenom"]:"");
    $matricule=(isset($_POST["matricul"])?$_POST["matricul"]:"");
   $pdo->execute("UPDATE `abonnes` SET`prenom`='$prenom' WHERE id_abonnes=$matricule");
    header("location:../abooner.php");
  }
  // la function password permet a l'aministrateur de modifier son mots de passe 
  function  password(){
    global $pdo;
    $password=(isset($_POST["npasse"])?$_POST["npasse"]:"");//recuperation des donnée 
    $password2=(isset($_POST['npasse1'])?$_POST['npasse1']:''); //recuperation des donnée 

    if($password!=$password2){// verification des mots de passe 
      header('location:../form/modifadmin.php?error=1&&message= Mots de passe differant');
      //redirection avec message d'erreurs au cas ou il y a des erreur 
    }elseif(strlen($password)<6){
      header('location:../form/modifadmin.php?error=1&message=mots de passe faible');
       //redirection avec message d'erreurs au cas ou il y a des erreur 
      exit();
    }else{

    $npasse=(isset($_POST["npasse"])?$_POST["npasse"]:"");
    
    $matricule=(isset($_POST["matricul"])?$_POST["matricul"]:"");
    $pdo->execute("UPDATE `admine` SET `modpass` = '$npasse' WHERE `identifiant`='$matricule'");
    header("location:../index.php");
    }
  }
  // la function passworduser permet a l'utilisateur de modifier son mots de passe 

  function  passworduser(){
    global $pdo;
   
    $password=(isset($_POST["npasse"])?$_POST["npasse"]:"");
    $password2=(isset($_POST['npasse1'])?$_POST['npasse1']:'');

    if($password!=$password2){// verification des mots de passe
      header('location:../form/modifuser.php?error=1&&message= Mots de passe differant');
       //redirection avec message d'erreurs au cas ou il y a des erreur 
    }elseif(strlen($password)<8){
      header('location:../form/modifuser.php?error=1&message=mots de passe faible');
       //redirection avec message d'erreurs au cas ou il y a des erreur 

      exit();
    }else{
      //cryptage du mots de passe avant l'envoir dans la base de donnée
      $password= "2001.6.4".sha1($password.'(85+45-86)');

      $matricule=(isset($_POST["matricul"])?$_POST["matricul"]:"");
      $pdo->execute("UPDATE `inscription` SET `modpass` = '$password' WHERE `mail`='$matricule'");
      header("location:../index.php");
    }
    
  }
  // la function password permet a l'aministrateur de modifier son mots de passe 
  function  passwordamin(){
    global $pdo;
   
    $password2=(isset($_POST['npasse1'])?$_POST['npasse1']:'');
    $npasse=(isset($_POST["npasse"])?$_POST["npasse"]:"");

    if($npasse!=$password2){// verification des mots de passe
      header('location:../form/modifuser.php?error=1&&message= Mots de passe differant');
       //redirection avec message d'erreurs au cas ou il y a des erreur 
    }elseif(strlen($npasse)<6){
      header('location:../form/modifuser.php?error=1&message=mots de passe faible');
       //redirection avec message d'erreurs au cas ou il y a des erreur 
      exit();
    }else{
      //cryptage du mots de passe avant l'envoir dans la base de donnée
      $npasse= "2001.6.4".sha1($npasse.'(85+45-86)');
      $matricule=(isset($_POST["matricul"])?$_POST["matricul"]:"");
      $pdo->execute("UPDATE `admine` SET `modpass` = '$npasse' WHERE `identifiant`='$matricule'");
      header("location:../index.php");
    }
    
  }
  // la fuction  editlivre permet de modifier le livre
  function editlivre(){
    global $pdo;
    $titre=(isset($_POST["titre"])?$_POST["titre"]:"");//recuperation des données titres
    $auteur=(isset($_POST["auteur"])?$_POST["auteur"]:"");//recuperation des données nom auteur
    $matricule=(isset($_POST["matricul"])?$_POST["matricul"]:""); //recuperation des donnée matricule   
    $pdo->execute("UPDATE `livre` SET `auteur`='$auteur',`titre`='$titre' WHERE id_livre=$matricule"); //envoire des donnée dans le base de donnée
    header("location:../admine/livre.php");
  }
  
  // la fuction editempruntuser permet de modifier le livre emprunt par l'utilisateur 
  function editempruntuser(){
    global $pdo;
    $livre=(isset($_POST["id_livre"])?$_POST["id_livre"]:"");
    //recuperation des données titres
    $dates=(isset($_POST["dates"])?$_POST["dates"]:"");
    //recuperation des données date de sortie 
    $dater=(empty($_POST["dater"])?"NULL":"'".$_POST['dater']."'");
    //recuperation des données date de rendut
    $matricule=(isset($_POST["matricul"])?$_POST["matricul"]:"");
    //recuperation des donnée matricule
    
    if($_POST["dater"] < date("Y-m-d ")) { //verification des dates 
      header("location:". $_SERVER['HTTP_REFERER'] );//rediction vers la page precedente 
    }else{
     $pdo->execute("UPDATE `empruntuser` SET `id_livres`='$livre',`date_sortie`='$dates',`date_rendu`=$dater WHERE   id_empruntuser=$matricule"); 
     if(isset($_SESSION['admin'])){
      header("location:../admine/emprunt.php");
     }elseif(isset($_SESSION['connect'])){
      header("location:../user/empruntuser.php");
     }
    }
  }
  // la fuction editemprunt permet de modifier le livre emprunt
  function editemprunt(){
    global $pdo;
    $abonne=(isset($_POST["id_abonne"])?$_POST["id_abonne"]:"");//recuperation des donné des id_abonnée 
    $livre=(isset($_POST["id_livre"])?$_POST["id_livre"]:"");//recuperation des donnée id_livre
    $dates=(isset($_POST["dates"])?$_POST["dates"]:"");//recuperation des donnée date de sortie 
    $dater=(empty($_POST["dater"])?"NULL":"'".$_POST['dater']."'");  //recuperation des données date de rendut
    $matricule=(isset($_POST["matricul"])?$_POST["matricul"]:"");  //recuperation des données matricule
    $pdo->execute("UPDATE `emprunt` SET `id_abonnes`='$abonne',`id_livres`='$livre',`date sortie`='$dates',`date_rendu`=$dater WHERE  id_emprunt=$matricule"); //envoir de donnée dans la base de donnée  
     header("location:../emprunt.php");//redirection des vers la page emprunt
  }
  //Supression des donner de la base de donner
  function delectabonner(){
    global $pdo;
    $indexabo=$_GET["index"];//recuperation de la id_utilisateur
    $pdo->execute("DELETE FROM `inscription` WHERE id_userinscri=$indexabo");
    header("location:../admine/abonner.php");
  
  }
  function delectlivre(){
    global $pdo;
    $indexlivre=$_GET["index"];//recuperation de la id_livre
    $pdo->execute("DELETE FROM `livre` WHERE id_livre=$indexlivre");
    header("location:../admine/livre.php");
  
  }
  function delectemprunt(){
    global $pdo;
    $indexempr=$_GET["index"];//recuperation de la id_empruntuser
    $pdo->execute("DELETE FROM `empruntuser` WHERE id_empruntuser=$indexempr");
    header("location:../admine/emprunt.php");
  
  }
  function delectempruntuser(){
    global $pdo;
    $indexempruser=$_GET["index"];//recuperation de la delectempruntuser
    $pdo->execute("DELETE FROM `empruntuser` WHERE  	id_empruntuser=$indexempruser");
    header("location:../user/empruntuser.php");
  }
  
  
   
  
   
   

   
   
?>