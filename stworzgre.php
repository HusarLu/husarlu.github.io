<?php
  	
  header('refresh: 1;');

  session_start();  

  require_once "connect.php";

  $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

  if(!isset($_SESSION['zalogowany'])){

    header('location: index.php');
    exit();

  }

  $nr = mysqli_query($polaczenie,"select pozycja_pokuj from uzytkownicy where login='".$_SESSION['$user']."'");

  $nrpokoju = $nr->fetch_row();

  $ktora = mysqli_query($polaczenie,"select id_gry from gry where p".$nrpokoju[0]."='".$_SESSION['$user']."'");

  $ktoragra = $ktora->fetch_row();

  $runda = mysqli_query($polaczenie,"select runda from gry where id_gry=".$ktoragra[0]."");

  $runda = $runda->fetch_row();

  if($runda[0] > 0 ){
    header('location: gra.php');
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ANIME - QUIZ</title>
    <link rel="stylesheet" type="text/css" href="style/style.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script language="javascript" type="text/javascript">
    var timeout = setInterval(reload, 1000);    
    function reload () {
     $('article.stworz').load('strstatus.php');
    }
    </script>
  </head>
  <body>
    <nav>
      <img class="logo" src="grafika/logo.png"/>
      <hr class="herka">
      <a href="profil.php" class="menu">Profile</a>
      <a href="szukaniegier.php" class="menu">Rooms</a>
      <?php

        $zapytanie1 = mysqli_query($polaczenie,"select status from uzytkownicy where login='".$_SESSION['$user']."';"); 

        $status = $zapytanie1->fetch_row();

        if($status[0] == 0){
          echo '<a href="tworzeniepokoju.php" class="menu">Create a room</a>';
        }else{
          echo '<a href="tworzeniepokoju.php" class="menu">My rooms</a>';
        }
      ?>
      <a href="logout.php" class="menu">Logout</a>
      <hr class="herka">
    </nav>
    <main id="main">
      <article class="stworz">
        <h1 class="tytul">Room
        <?php
        require_once "connect.php";

        $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
        $nr = mysqli_query($polaczenie,"select pozycja_pokuj from uzytkownicy where login='".$_SESSION['$user']."'");

        $nrpokoju = $nr->fetch_row();

        $ktora = mysqli_query($polaczenie,"select id_gry from gry where p".$nrpokoju[0]."='".$_SESSION['$user']."'");

        $ktoragra = $ktora->fetch_row();

        $ile = mysqli_query($polaczenie,"select ile_graczy from gry where p".$nrpokoju[0]."='".$_SESSION['$user']."'");

        $ilegraczy = $ile->fetch_row();

        echo "#".$ktoragra[0];

        for( $a = 1; $a <= $ilegraczy[0]; $a++ ){
          $p1 = mysqli_query($polaczenie,"select p".$a." from gry where id_gry='".$ktoragra[0]."'");

          $p1 = $p1->fetch_row();

          $zdj = mysqli_query($polaczenie,"select zdj from uzytkownicy where login='".$p1[0]."'");

          $zdj = $zdj->fetch_row();

          echo '<h1>
          <figure>
          <img class="osoba" src="profilowe/'.$zdj[0].'"/>
          <figcaption class="podpis">
          '.$p1[0].'
          </figcaption>
          </figure>
          </h1>';
        }
        if($nrpokoju[0] == 1){
          echo '<a href="startgry.php" class="tytul">Start</a>';
        }

        $polaczenie->close();
        ?>
        <a href="usun.php" class="tytul">Leave</a>
      </article>
    </main>
  </body>
</html>