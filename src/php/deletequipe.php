<?php 

    include("connectbasddoner.php"); 

    $id = $_POST["id"] ; 
    $quer = "DELETE FROM equipement WHERE id = $id" ;
    $testquer =  $connnect  -> query($quer) ; 

    if($testquer) {
        echo "9dit gharad" ;
    }
?>