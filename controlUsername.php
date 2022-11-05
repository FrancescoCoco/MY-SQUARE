<?php
 
        $conn =mysqli_connect("151.97.9.184", "coco_francescomaria", "7592265140", "coco_francescomaria") or die("Errore: ".mysqli_connect_error());
        $utenti = array();
        $res = mysqli_query($conn, "SELECT * FROM Utenti");
        while($row = mysqli_fetch_assoc($res))
        {
              $utenti[] = $row;
        }
        mysqli_free_result($res);
        mysqli_close($conn);
        echo json_encode($utenti);
?>