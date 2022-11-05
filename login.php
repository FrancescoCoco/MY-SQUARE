<?php
   session_start();
    if(isset($_COOKIE["nomeUtente"]) || isset($_SESSION["nomeUtente"]))
    {   
        header("Location: home.php");
        exit;
    }

    if(isset($_POST["nomeUtente"]) && isset($_POST["password"]))
    {
        
        $conn =mysqli_connect("151.97.9.184", "coco_francescomaria", "7592265140", "coco_francescomaria") or die("Errore: ".mysqli_connect_error());
        $query = "SELECT * FROM utenti WHERE nomeUtente = '".$_POST['nomeUtente']."' AND password = '".$_POST['password']."'";
        $res = mysqli_query($conn, $query);
        
        if(mysqli_num_rows($res) > 0)
        {   
            if(!isset($_POST['cookie'])){
                $_SESSION["nomeUtente"]=$_POST['nomeUtente'];
                header("Location: home.php");
                exit;
            }

            if(isset($_POST['cookie'])){
                setcookie("nomeUtente",$_POST['nomeUtente'],time()+60);
                $_SESSION["nomeUtente"]=$_POST['nomeUtente'];
                header("Location: home.php");
                exit;
            }
        }
        else
        {    
            mysqli_free_result($res);
            mysqli_close($conn);
            $errore = true;
        }
    }
    ?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Login MySquare </title>
        <script src='login.js' defer></script>
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
                <span id = 'tastoLog' > Login</span> 
                <span id = 'tastoSubscribe' class='overlay'> <a href= "signup.php"> Subscribe </a> </span>
            </div>
        
            <div class = 'campo'>
            <form id = "LogIn" action = 'login.php' method = 'POST'>
                        <p>
                            <label>Nome_Utente <input type='text' name='nomeUtente'></label>
                        </p>

                        <p>
                            <label>Password<input type='password' name='password'></label>
                        </p>
                        
                        <p class = 'Ricordami'>
                            <label>Ricordami<input type='checkbox' name='cookie'></label>
                        </p>
                        <p class= "TastoAccedi"  >  
                             <label>&nbsp;<input type='submit'value= "Accedi"></label>
                        </p>

            </form> 
            <span id = "Errore" ></span>
            <?php
            if(isset($errore) && $errore==true)
            {
                echo "<p class='Errore'>";
                echo "Credenziali non valide.";
                echo "</p>";
            }
            ?>
            </div>
            </main>
    </body>
</html>