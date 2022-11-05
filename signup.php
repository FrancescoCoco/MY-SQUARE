<?php
  
  session_start();
  if(isset($_COOKIE["nomeUtente"]) || isset($_SESSION["nomeUtente"]))
  {   
      header("Location: home.php");
      exit;
  }

if(isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["email"]) && isset($_POST["nomeUtente"]) && isset($_POST["password"]) && isset($_POST["Cpassword"]) && $_POST["Cpassword"]== $_POST["password"])
{   
    if(strpos($_POST["email"],"@")===false){
        $errorEmail = true;
    }
    else {
    $conn = mysqli_connect("151.97.9.184", "coco_francescomaria", "7592265140", "coco_francescomaria") or die("Errore: ".mysqli_connect_error());
    $query = "SELECT * FROM utenti WHERE nomeUtente = '".$_POST['nomeUtente']."'";
    $res = mysqli_query($conn, $query);
    if(mysqli_num_rows($res) == 0){
    $nome = mysqli_real_escape_string($conn, $_POST["nome"]);
    $cognome = mysqli_real_escape_string($conn, $_POST["cognome"]);
    $nomeUtente = mysqli_real_escape_string($conn, $_POST["nomeUtente"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
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
    $inserimento  = "INSERT INTO Utenti VALUES(\"$nome\", \"$cognome\", \"$email\",\"$nomeUtente\",\"$password\",\"$avatar\")";
    mysqli_query($conn, $inserimento);
    mysqli_free_result($res);
    mysqli_close($conn);
    $_SESSION["nomeUtente"]=$_POST['nomeUtente'];
    header("Location: home.php");
    exit;
    }  
    else
    {   
        mysqli_free_result($res);
        mysqli_close($conn);
        $errore= true;
    }
}
}
 
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Register My Square</title>
        <script src='signup.js' defer></script>
        <link rel='stylesheet' href='styleLogin.css'>
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Roboto|Source+Sans+Pro&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&display=swap" rel="stylesheet">     
</head>
    <body>
        
        <header>
            <h1>MY SQUARE </h1>
        </header>

        <main>
            <div class = 'tasti' >
                <span id = 'tastoLog' class='overlay' > <a href= "login.php"> Login</a> </span> 
                <span id = 'tastoSubscribe' > Subscribe</span>
            </div>
        
            <div class = 'campo'>
            
            <form id = "Iscrizione"  action = 'signup.php' method = 'POST' enctype="multipart/form-data">
                <p>
                <label>Nome <input type='text' name='nome'></label>
                </p>
                <p>
                <label>Cognome <input type='text' name='cognome'></label>
                </p>
                <p>  
                    <p>
                        <label>Email <input type='text' name='email'></label>
                        </p>
                        <p>
                        <label id='nomeUtente' >Nome_Utente <input type='text' name='nomeUtente'></label>
                        </p>
                        <p>
                            <label>Password<input type='password' name='password'></label>
                            </p>
                            <p>
                                <label>Conferma Password<input type='password' name='Cpassword'></label>
                                </p>
                                <p>
                                <label>Immagine del profilo(URL) <input type="file" name='avatar'></label>
                                </p>
                            <p class='TastoInvio'>
                         <label>&nbsp;<input type='submit' value="Registrati"></label>
                             </p>
                </form> 
            <span id = "Errore" ></span>
            <span id = "ErrorePassword" ></span>
            <span id = "ErroreMail" ></span>
            <span id ="ErroreNomeUtente"></span>
            </div>
            </main>
    </body>
</html>