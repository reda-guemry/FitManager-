<?php 
    include("connectbasddoner.php") ; 

    if(isset($_POST["addcours"])){
        $nom = $_POST["nom"] ;
        $categorie = $_POST["categorie"] ;
        $heure = $_POST["heure"] ;
        $day = $_POST["day"];
        $duree = $_POST["duree"];
        $number = $_POST["number"] ; 

        $postquery = "INSERT INTO cours (nom, categorie, heure, date, duree, max_participants) VALUE ('$nom', '$categorie ', '$heure ', '$day ', '$duree ', '$number')" ;

        if($connnect -> query("$postquery")){
            $succses = true;
            echo "<script> alert('add cmplete')</script>";
        }else {
            $succses = false ;
            $ereur = $connnect -> error ; 
            echo"<script>alert({$ereur})</script> " ; 
        }

        header("Location: ../../index.php"); 
        exit;
    } 


?> 