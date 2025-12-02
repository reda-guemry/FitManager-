<?php
  $host = "localhost" ;
  $user = "root" ; 
  $password = "root" ;
  $databse = "brief_sql" ;
  
  $connnect = new mysqli($host , $user , $password , $databse) ;

  if($connnect -> connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  
?>
