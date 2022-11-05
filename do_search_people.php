<?php
    session_start();
    if(!isset($_SESSION["nomeUtente"]))
    {   
        session_destroy();
        header("Location: login.php");
        exit;
    }
     
    else { 
        if(!isset($_POST['utenti'])){
        header("Location: search_people.php");
        exit;
        }

        else {
        $utenti= array();
        $testo =$_POST['utenti'];
        $conn = mysqli_connect("151.97.9.184", "coco_francescomaria", "7592265140", "coco_francescomaria") or die("Errore: ".mysqli_connect_error());
        if($testo =='tutti'){
          $query="SELECT * FROM utenti WHERE nomeUtente  != '".$_SESSION['nomeUtente']."'";
        }
        else{
        $query = "SELECT * FROM utenti WHERE nomeUtente LIKE '%".$_POST['utenti']."%' AND nomeUtente != '".$_SESSION['nomeUtente']."'";
        }
        $res = mysqli_query($conn, $query);
        while($row = mysqli_fetch_assoc($res)){
          $seguito=$row['nomeUtente'];
          $seguace=$_SESSION['nomeUtente'];
          $query2 = "SELECT seguito FROM  follower WHERE seguito= '$seguito' and seguace = '$seguace' ";
          $res2 = mysqli_query($conn, $query2);
          if(mysqli_num_rows($res2) == 0){
              $infoFollow = [
                'seguito' => $seguito,
                'isfollow' => '0'
              ];
            }
            else {
                  $infoFollow = [
                  'seguito' => $seguito,
                  'isfollow' => '1'
                  ];
                }
          mysqli_free_result($res2);
          $utentiInfo= $row + $infoFollow;
          $utenti[]= $utentiInfo;
          }
        mysqli_free_result($res);
        mysqli_close($conn);
        echo json_encode($utenti);
        }
      }
?>