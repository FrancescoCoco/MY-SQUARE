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
        $query = "SELECT seguace FROM follower WHERE seguito = '".$_SESSION['nomeUtente']."'"; 
        $res = mysqli_query($conn, $query);
        if(mysqli_num_rows($res)==0){
            $seguaceInfo= [
                'seguace' => "Nessun Utente"
            ];
            $seguaceImage = [
                'seguaceImage' => 'Assente.jpg'
            ];
            $utenti[]= $seguaceInfo + $seguaceImage;
        }
        else {
        while($row = mysqli_fetch_assoc($res))
        {
              $seguace = $row['seguace'];
              $seguaceInfo=[
                  'seguace' => $row['seguace']
              ];
              $query2 = "SELECT avatar FROM utenti WHERE nomeUtente =  '$seguace' ";
              $res2 = mysqli_query($conn, $query2);
              while($row2 = mysqli_fetch_assoc($res2)){
                  $seguaceImage = [
                      'seguaceImage' => $row2['avatar']
                  ];
              }
              $utenti[]= $seguaceInfo+$seguaceImage;
        }    
    }
        mysqli_close($conn);
        echo json_encode($utenti)
    ?>