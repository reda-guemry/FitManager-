<?php 
    include("connectbasddoner.php") ; 

        $nom = $_POST["nom"] ;
        $categorie = $_POST["categorie"] ;
        $heure = $_POST["heure"] ;
        $day = $_POST["day"];
        $duree = $_POST["duree"];
        $number = $_POST["number"] ; 

        $postquery = "INSERT INTO cours (nom, categorie, heure, date, duree, max_participants) VALUE ('$nom', '$categorie ', '$heure ', '$day ', '$duree ', '$number')" ;

        $connnect -> query("$postquery") ; 
        
        header("Location: ../../index.php"); 
        exit;


?> 