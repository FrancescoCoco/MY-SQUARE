<?php
        $utente = array();
        $nomeUtente = $_GET['nomeUtente'];
        $conn = mysqli_connect("151.97.9.184", "coco_francescomaria", "7592265140", "coco_francescomaria") or die("Errore: ".mysqli_connect_error());
        $query = "SELECT * FROM utenti WHERE nomeUtente = '$nomeUtente'"; 
        $res = mysqli_query($conn, $query);
        while($row = mysqli_fetch_assoc($res))
        {
              $info= $row;
        }
        mysqli_free_result($res);
        $query2 = "SELECT COUNT(seguito) as seguiti FROM follower WHERE seguace = '$nomeUtente'"; 
        $res2 = mysqli_query($conn, $query2);
        if(mysqli_num_rows($res2)==0){
            $seguiti=[
                'seguiti' => '0'
            ];
        }
        else {
        while($row2 = mysqli_fetch_assoc($res2))
        {
              $seguiti= $row2;
        }
    }
        mysqli_free_result($res2);

        $query3 = "SELECT COUNT(seguace) as seguaci FROM follower WHERE seguito ='$nomeUtente'"; 
        $res3 = mysqli_query($conn, $query3);
        if(mysqli_num_rows($res3)==0){
            $seguaci=[
                'seguaci' => '0'
            ];
        }
        else {
        while($row3 = mysqli_fetch_assoc($res3))
        {
              $seguaci= $row3;
        }
    }
        mysqli_free_result($res3);  
        mysqli_close($conn);
        $utente[]=$info+$seguiti+$seguaci;
        echo json_encode($utente);
    ?>