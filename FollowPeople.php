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
        $seguace = $_SESSION['nomeUtente'];
        $seguito = $_GET['seguito'];
        $query = "INSERT INTO follower VALUES (\"$seguace\",\"$seguito\")";
        $res = mysqli_query($conn, $query);
        $testo= "Segui_già";
        echo $testo;
        }
?>