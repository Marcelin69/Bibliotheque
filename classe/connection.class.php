<?php
// $query=$cone->prepare("select c.*,(select nomcomplet from clients where id_client=c.id_client) as nom from commandes c;");
// ->execute();
// $affiche=$query->fetchAll();
// // print "<pre>";
//  print_r($affiche);

 class Connection{
  
  public $connection;

  function __construct(){
    $this->connection= new PDO("mysql:host=localhost;dbname=projet_final;charset=utf8",'root','');
  }
 
  /* la function fetchAll */
 function fetchAll($query){
   $tmp=$this->connection->prepare($query);
   $tmp->execute();
   return $tmp->fetchAll();

 }
 
 /* la function fetch */
 function fetch($query){
  $tmp=$this->connection->prepare($query);
  $tmp->execute();
  return $tmp->fetch();

}

  /* la function d'execution */
function execute($query){
  $tmp=$this->connection->prepare($query);
  $tmp->execute();
  
}



 }



?>
