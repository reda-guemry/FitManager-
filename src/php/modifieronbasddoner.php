<?php

    include("connectbasddoner.php") ;

    header("Content-Type: application/json") ; 

    $satajs = file_get_contents("php://input") ; 
    
    $data = json_decode( $satajs , true) ; 
    $data = $data["newdata"] ; 

    $idcherch = $data["id"] ;
    $newnam = $data["nom"] ; 
    $newcategorie = $data["categorie"] ;
    $newheure = $data["heure"] ; 
    $newdaye = $data["day"] ; 
    $newduree = $data["duree"] ; 
    $maxparticipent = $data["number"] ; 

    $modif = "UPDATE cours SET nom = '$newnam', categorie = '$newcategorie', heure = '$newheure', date = '$newdaye', duree = '$newduree', max_participants = '$maxparticipent' WHERE id = '$idcherch'";

    $upate = $connnect -> query($modif) ; 

    $succermodif = $connnect -> query("SELECT * FROM cours WHERE id = '$idcherch' ") ;
    $modifirow = $succermodif -> fetch_assoc() ;
    echo json_encode($modifirow) ; 

    
?> 