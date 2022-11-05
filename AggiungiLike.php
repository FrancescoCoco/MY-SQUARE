<?php
session_start();
if(!isset($_SESSION["nomeUtente"]))
{   
    session_destroy();
    header("Location: login.php");
    exit;
}
 
  $nomeUtente = $_SESSION["nomeUtente"];
  $post= $_GET['idPost'];
  $conn = mysqli_connect("151.97.9.184", "coco_francescomaria", "7592265140", "coco_francescomaria") or die("Errore: ".mysqli_connect_error());
  $query1 ="INSERT into likes(nomeUtente,post) values('$nomeUtente','$post')";
  $res1 = mysqli_query($conn, $query1);
  $query2 = "SELECT count(l.post) as numeroLikes , p.id as idPost from post p
   JOIN likes l on  post=$post and l.post = p.id  group by(p.id)";
  $res2 = mysqli_query($conn, $query2);
  if(mysqli_num_rows($res2) == 0){
    $utenti[] = [
      'numeroLikes' => '0',
      'idPost' => $post,
      'isLiked' => '0'
    ];
      echo json_encode($utenti);
      
  }
  else {
  while($row2 = mysqli_fetch_assoc($res2))
        {
          $isLiked = [
            'isLiked' => '1'
          ];
              $utenti[] = $row2 + $isLiked;
        }
        mysqli_free_result($res2);
        mysqli_close($conn);
        echo json_encode($utenti);
      }
?>