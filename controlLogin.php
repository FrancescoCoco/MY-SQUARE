<?php
        session_start();
        if(isset($_SESSION["nomeUtente"]))
        {   
        header("Location: home.php");
        exit;
        }
        mysqli_connect("151.97.9.184", "coco_francescomaria", "7592265140", "coco_francescomaria") or die("Errore: ".mysqli_connect_error());
        $utenti = array();
        $query = "SELECT * FROM utenti WHERE nomeUtente = '".$_POST['nomeUtente']."' AND password = '".$_POST['password']."'";
        $res = mysqli_query($conn, $query);
        if(mysqli_num_rows($res) == 0){
            $text = 0;
        }
        else { 
            $text = 1;
        }
        echo $text;
?>