<?php
  $utenti = array();
  $post= $_GET['idPost'];
  $conn = mysqli_connect("151.97.9.184", "coco_francescomaria", "7592265140", "coco_francescomaria") or die("Errore: ".mysqli_connect_error());
  $query = "SELECT likes.nomeUtente as utentiLikes , likes.post as post from likes 
  where likes.post= $post";
  $res = mysqli_query($conn, $query);
  if(mysqli_num_rows($res) == 0){
    $utenti[] = [
      'utentiLikes' => 'Nessun Utente',
      'idPost' => $post,
      'fotoProfilo' => 'Assente'
    ];
      echo json_encode($utenti);
      
  }
  else {
  while($row = mysqli_fetch_assoc($res))
        {
          $utente= $row['utentiLikes'];
          $query2 = "SELECT avatar as fotoProfilo from utenti where nomeUtente = '$utente'";
          $res2 = mysqli_query($conn, $query2);
          while($row2 = mysqli_fetch_assoc($res2)){
            $fotoProfilo=[
              'fotoProfilo' => $row2['fotoProfilo']
            ];
          }
              $info = $fotoProfilo + $row;
              $utenti[]= $info;
              mysqli_free_result($res2);
        }
        mysqli_free_result($res);
        mysqli_close($conn);
        echo json_encode($utenti);
      }
?>
    
    
    