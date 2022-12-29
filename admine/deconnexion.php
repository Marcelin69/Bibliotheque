<?php
session_start(); //initialisation des session
session_unset(); // Desativation des action
session_destroy(); //Destruition de la session
setcookie('log','',time()-3444,'/',null,false,true,);//detruire un cooki
header('location:../index.php');
?>