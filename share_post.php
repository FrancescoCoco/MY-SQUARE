<?php
    
    session_start();
    if(!isset($_SESSION["nomeUtente"]))
    {   
    session_destroy();
    header("Location: login.php");
    exit;
    }
     
    else { 
        
        $conn = mysqli_connect("151.97.9.184", "coco_francescomaria", "7592265140", "coco_francescomaria") or die("Errore: ".mysqli_connect_error());
        $nomeUtente = $_SESSION['nomeUtente'];
        $url = $_GET['image'];
        $titolo= $_GET['titolo'];
        $datacorrente= date('Y-m-d H:i:s');
        $query = "INSERT INTO post (titolo,url,nomeUtente,dataPost) VALUES (\"$titolo\",\"$url\",\"$nomeUtente\",\"$datacorrente\")";
        $res = mysqli_query($conn, $query);
        if($res === false){
           $testo = "Problema nella condivisione";
           echo "$testo";
           exit;
        }
        $testo = "Post condiviso";
        echo "$testo";
        }
?>