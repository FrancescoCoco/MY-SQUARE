<?php
  
    session_start();
    if(!isset($_SESSION["nomeUtente"])&& !isset($_COOKIE['nomeUtente']))
    {   
    session_destroy();
    header("Location: login.php");
    exit;
    }

    else if(!isset($_SESSION['nomeUtente'])&& isset($_COOKIE['nomeUtente'])){
        $_SESSION['nomeUtente']= $_COOKIE['nomeUtente'];
    }

        $nomeUtente = $_SESSION["nomeUtente"];
        $conn = mysqli_connect("151.97.9.184", "coco_francescomaria", "7592265140", "coco_francescomaria") or die("Errore: ".mysqli_connect_error());
        $query = "SELECT * FROM utenti WHERE nomeUtente = '".$_SESSION['nomeUtente']."'"; 
        $res = mysqli_query($conn, $query);
        while($row = mysqli_fetch_assoc($res))
        {
              $utenti= $row;
        }
        mysqli_free_result($res);
        
        $nome = $utenti['nome'];
        $cognome = $utenti['cognome'];
        $email = $utenti['email'];
        $avatar = $utenti['avatar'];

        $query2 = "SELECT COUNT(seguito) as seguiti FROM follower WHERE seguace = '".$_SESSION['nomeUtente']."'"; 
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

        $query3 = "SELECT COUNT(seguace) as seguaci FROM follower WHERE seguito = '".$_SESSION['nomeUtente']."'"; 
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
        $numero_seguaci = $seguaci['seguaci'];    
        mysqli_close($conn);
    ?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Home MySquare $nomeUtente </title>
        <script src='home.js' defer></script>
        <link rel='stylesheet' href='home.css'>
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Roboto|Source+Sans+Pro&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&display=swap" rel="stylesheet">     
</head>
    <body>
    <nav id = "barra">
        <nav id= "menu">
        <div id="menuBar"> 
          <div></div>
          <div></div>
          <div></div>
        </div>
        <a href="home.php" id="Logo">MYSQ</a>
        <a href="search_people.php" class = "Boxes" id = "searchPeople">Cerca Persone</a>
        <a href="home.php" class = "Boxes" id = "home">Home</a>
        <a href="search_content.php" class = "Boxes" id = "searchContent">Cerca Post</a>
        <a href ="logout.php" class="Boxes" id = "logout">Logout</a> 
        </nav>
        <nav id= "profilo">
        <?php
           echo "<span class= 'boxInfoUtenteNav'>";
            if(isset($numero_seguiti))
            {   
                echo "<span id='seguiti'>";
                echo "Seguiti: "."$numero_seguiti";
                echo "</span>";
            }
            if(isset($numero_seguaci))
            {   
                echo "<span id='seguaci'>";
                echo "Follower: "."$numero_seguaci";
                echo "</span>";
            }
            echo "</span>"
             ?>
         <span id="avatar">
            <?php
            if(isset($avatar))
            {   
                echo "<img src= '$avatar'/>";
            }
            ?>
            </span>
            <?php
            
            if(isset($nomeUtente))
            {   
                echo "<span id='nomeUtente'>";
                echo $nomeUtente;
                echo "</span>";
            }
             ?>
        </nav>
    </nav>
    <div id= "Posts">
    </div>
    <section id="modal-view" class="hidden">
    </section>
    </body>
</html>