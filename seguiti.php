<?php
session_start();
        if(!isset($_SESSION["nomeUtente"]))
        {   
            session_destroy();
            header("Location: login.php");
            exit;
        }
        $nomeUtente = $_SESSION["nomeUtente"];
        $utenti = array();
        $conn = mysqli_connect("151.97.9.184", "coco_francescomaria", "7592265140", "coco_francescomaria") or die("Errore: ".mysqli_connect_error());
        $query = "SELECT seguito FROM follower WHERE seguace = '".$_SESSION['nomeUtente']."'"; 
        $res = mysqli_query($conn, $query);
        if(mysqli_num_rows($res)==0){
            $seguitoInfo= [
                'seguito' => "Nessun Utente"
            ];
            $seguitoImage = [
                'seguitoImage' => 'Assente.jpg'
            ];
            $utenti[]= $seguitoInfo + $seguitoImage;
        }
        else {
        while($row = mysqli_fetch_assoc($res))
        {
              $seguito = $row['seguito'];
              $seguitoInfo= [
                  'seguito' => $row['seguito']
              ];
              $query2 = "SELECT avatar FROM utenti WHERE nomeUtente = '$seguito'";
              $res2 = mysqli_query($conn, $query2);
              while($row2 = mysqli_fetch_assoc($res2)){
                  $seguitoImage = [
                      'seguitoImage' => $row2['avatar']
                  ];
              }
              $utenti[]= $seguitoInfo + $seguitoImage;
        }    
    }
        mysqli_close($conn);
        echo json_encode($utenti)
    ?>