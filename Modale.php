<?php
    $utente = array();
    $conn = mysqli_connect("151.97.9.184", "coco_francescomaria", "7592265140", "coco_francescomaria") or die("Errore: ".mysqli_connect_error());
    $query = "SELECT * FROM utenti WHERE nomeUtente = '".$_GET['cliccato']."'"; 
    $res = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($res))
    {
          $info= $row;
    }
    $query2 = "SELECT COUNT(seguito) as seguiti FROM follower WHERE seguace = '".$_GET['cliccato']."'"; 
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
        $numero_seguiti = $seguiti['seguiti'];

        $query3 = "SELECT COUNT(seguace) as seguaci FROM follower WHERE seguito = '".$_GET['cliccato']."'"; 
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
    $utenteinfo= $info + $seguiti +$seguaci;
    $utente[]= $utenteinfo;
    mysqli_free_result($res);
    mysqli_close($conn);
    echo json_encode($utente);
    
?>