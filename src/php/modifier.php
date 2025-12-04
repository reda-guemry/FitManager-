<?php 
    include("connectbasddoner.php") ;

    header("Content-Type: application/json") ;

    $idrecherch = $_POST["id"] ; 

    $get = "SELECT * FROM cours WHERE id = $idrecherch" ; 
    $rowcherche = $connnect -> query($get) ; 
    $resultfinal = $rowcherche -> fetch_assoc() ; 

    echo json_encode($resultfinal) ;


?>