<?php
  session_start();
  if(!isset($_SESSION["nomeUtente"]))
  {   
      session_destroy();
      header("Location: login.php");
      exit;
  }
    else {
        $nomeUtente = $_SESSION["nomeUtente"];
        $utenti = array();
        $postInfo= array();
        $conn = mysqli_connect("151.97.9.184", "coco_francescomaria", "7592265140", "coco_francescomaria") or die("Errore: ".mysqli_connect_error());
        $query = "SELECT  u.nomeUtente as nomeUtente, u.avatar as Imageuser, p.id as idPost,
        p.Titolo as titoloPost, p.Url as ImagePost , p.dataPost as dataPost
        from utenti u join follower f join post p on f.seguace = '".$_SESSION['nomeUtente']."'
        and f.seguito=p.nomeUtente and f.seguito = u.nomeUtente and p.nomeUtente = u.nomeUtente or
        (u.nomeUtente='".$_SESSION['nomeUtente']."' and p.nomeUtente= '".$_SESSION['nomeUtente']."') 
        group by(p.id) order by (p.dataPost) DESC";
        $res = mysqli_query($conn, $query);
        if(mysqli_num_rows($res)== 0){
          $query1 = "SELECT nomeUtente , avatar as Imageuser from utenti where 
          nomeUtente = '".$_SESSION['nomeUtente']."'";
          $res1 = mysqli_query($conn, $query1);
          while($row1 = mysqli_fetch_assoc($res1)){
            $infoUtente = $row1;
          }

          $query2="SELECT id as idPost, titolo as titoloPost, Url as ImagePost , dataPost FROM post where 
          nomeUtente = '".$_SESSION['nomeUtente']."' order by (dataPost) DESC";
          $res2 = mysqli_query($conn, $query2);
          while($row2 = mysqli_fetch_assoc($res2)){
          $infoPost = $row2;
          $idPost = $row2['idPost'];
          $utente= $_SESSION['nomeUtente'];
          $query3 = "SELECT * from likes  WHERE post = '$idPost' AND nomeUtente= '$utente'";
          $res3 = mysqli_query($conn, $query3);
          if(mysqli_num_rows($res3) == 0){
            $isLiked = [
              'isLiked' => '0',
            ];
          }
          else {
            $isLiked = [
              'isLiked' => '1',
            ];
          }
          mysqli_free_result($res3);
          $query4 = "SELECT count(l.post) as numeroLikes  from post p
          JOIN likes l on  post='$idPost' and l.post = p.id  group by(p.id)";
          $res4 = mysqli_query($conn, $query4);
          if(mysqli_num_rows($res4) == 0){
            $postLikes= [
              'numeroLikes' => '0',
            ];
          }

          else {
          while($row4 = mysqli_fetch_assoc($res4))
                {
                      $postLikes = $row4;
                }
          }
          mysqli_free_result($res4);
          $utenti[]= $infoUtente + $infoPost + $postLikes + $isLiked;
          }
          mysqli_free_result($res2);
          mysqli_close($conn);
          echo json_encode($utenti);
        }

        else {
        while($row = mysqli_fetch_assoc($res))
        {     
          $post= $row['idPost'];
          $utente= $_SESSION['nomeUtente'];
          $query2 = "SELECT * from likes  WHERE post = '$post' AND nomeUtente= '$utente'";
          $res2 = mysqli_query($conn, $query2);
          if(mysqli_num_rows($res2) == 0){
            $isLiked = [
              'isLiked' => '0',
            ];
          }
          else {
            $isLiked = [
              'isLiked' => '1',
            ];
          }
          mysqli_free_result($res2);
          $query3 = "SELECT count(l.post) as numeroLikes  from post p
          JOIN likes l on  post='$post' and l.post = p.id  group by(p.id)";
          $res3 = mysqli_query($conn, $query3);
          if(mysqli_num_rows($res3) == 0){
            $postLikes= [
              'numeroLikes' => '0',
            ];
          }

          else {
          while($row3 = mysqli_fetch_assoc($res3))
                {
                      $postLikes = $row3;
                }
          }
          mysqli_free_result($res3);
          $utenti[]= $row + $postLikes + $isLiked;
        }
        mysqli_free_result($res); 
        mysqli_close($conn);
        echo json_encode($utenti);
  }
}
    ?>
    