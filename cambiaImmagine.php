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
        $uploadDir = __DIR__;
    foreach ($_FILES as $file) {
        if (UPLOAD_ERR_OK === $file['error'] && $file['type'] == "image/jpeg" ) {
            $avatar = basename($file['name']);
            move_uploaded_file($file['tmp_name'], $uploadDir.DIRECTORY_SEPARATOR.$avatar);
        }
        else {
            $avatar = "https://www.gabrielevairos.it/wp-content/uploads/2014/10/Facebook-senza-foto.jpg";
        }
        }
        $conn = mysqli_connect("151.97.9.184", "coco_francescomaria", "7592265140", "coco_francescomaria") or die("Errore: ".mysqli_connect_error());
        $query = "UPDATE utenti SET avatar = '$avatar' WHERE nomeUtente= '$nomeUtente'";
        $res = mysqli_query($conn, $query);
        if(!$res){
            $text = "Immagine non inserita correttamente";
        }
        else{
            $text ="Immagine inserita correttamente, per visualizzare le modifiche aggiorna la pagina";
        }
        mysqli_close($conn);
        echo $text;  
    }
    ?>