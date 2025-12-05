<?php 

    include("connectbasddoner.php"); 

    $nom = $_POST["nom"] ; 
    $type = $_POST["type"] ; 
    $quentiter = $_POST["quantite"] ;
    $eteat = $_POST["quantite"] ; 

    $quer = "INSERT INTO equipement (nom , type , quuantiter , etat) VALUE ('$nom' ,'$type' , $quentiter , '$eteat')"  ; 
    $insert = $connnect -> query($quer) ; 

    header("Location: ../../index.php"); 
    exit;

?>