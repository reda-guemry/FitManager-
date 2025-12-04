<?php

    
    include("connectbasddoner.php") ;

    $idsupprumer = $_POST["id"];
    
    $seletquery = "DELETE FROM cours WHERE id = $idsupprumer" ; 
    $supp = $connnect -> query($seletquery) ; 

    if($supp) {
        echo "daaazt" ; 
    }

?>