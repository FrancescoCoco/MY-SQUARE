<?php
  session_start();
  if(!isset($_SESSION["nomeUtente"]))
  {   
      session_destroy();
      header("Location: login.php");
      exit;
  }
   
  else{
    $nomeUtente = $_SESSION["nomeUtente"];
    $conn = mysqli_connect("151.97.9.184", "coco_francescomaria", "7592265140", "coco_francescomaria") or die("Errore: ".mysqli_connect_error());
    $query1 = "SELECT * FROM utenti WHERE nomeUtente = '".$_SESSION['nomeUtente']."'"; 
    $res1 = mysqli_query($conn, $query1);
    while($row1 = mysqli_fetch_assoc($res1))
    {
          $utente= $row1;
    }
    mysqli_free_result($res1);
    mysqli_close($conn);
    $nome = $utente['nome'];
    $cognome = $utente['cognome'];
    $email = $utente['email'];
    $avatar = $utente['avatar'];
}    
  
?>

<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> SearchPeople </title>
        <script src='search_people.js' defer></script>
        <link rel='stylesheet' href='search_people.css'>
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
        <a href = "logout.php" class="Boxes" id = "logout">Logout</a> 
        </nav>
        <nav id= "profilo">
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
    </header>
    <div id ="ResearchResult">
    <span id = "RicercaUtenteBox">
    <h1 id ="Logo"> MY SQUARE </h1>
    <form id ="RicercaUtente" action= "do_search_people.php" method = 'POST' >
    <label><input type="search" placeholder="Cerca un utente" name='utenti'></label>
    <label>&nbsp;<input type='submit' value='Cerca'></label>
    </form>
    </span>
    <div id = "boxUtenti">
    </div>
    </div>
    <section id="modal-view" class="hidden">
    </section>
   </body>
</html>