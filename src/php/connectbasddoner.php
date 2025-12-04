<?php
  
  $connnect = new mysqli("localhost" , "root" , "root" , "brief_sql") ;

  if($connnect -> connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }


  $cours = $connnect -> query("SELECT * FROM cours") ; 
  $equipement = $connnect -> query ("SELECT * FROM equipement");

?>