<?php 
    include("connectbasddoner.php"); 

    header("Content-Type: application/json") ;
    
    $satajs = file_get_contents("php://input") ; 

    $datacomm = json_decode($satajs , true) ; 
    $dataajj = $datacomm["newdata"] ; 

    $id = $dataajj["id"] ; 
    $nom = $dataajj["nom"] ;
    $type = $dataajj["type"] ;
    $quuantiter = $dataajj["quuantiter"] ;
    $etat = $dataajj["etat"];

    $query = "UPDATE equipement SET nom='$nom' ,  type='$type' ,quuantiter='$quuantiter', etat='$etat' WHERE id = $id" ;
    $result =  $connnect -> query($query) ; 

    $testrep = $connnect -> query("SELECT * FROM equipement WHERE id = $id") ; 
    $rep = $testrep -> fetch_assoc() ; 
    echo json_encode($rep) ; 

?>