<?php 
    include("connectbasddoner.php") ;

    header("Content-Type: application/json");

    $id = $_POST["id"];

    $requet = "SELECT * FROM equipement WHERE id = $id" ; 
    $found = $connnect -> query($requet) ;
    $rep = $found -> fetch_assoc() ;  

    echo json_encode($rep)

?>