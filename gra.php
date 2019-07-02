<?php
  session_start();  

  if(!isset($_SESSION['zalogowany'])){

    header('location: index.php');
    exit();
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ANIME - QUIZ</title>
    <link rel="stylesheet" type="text/css" href="style/style_gra.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  </head>
  <body>
    <nav>
      <img class="logo" src="grafika/logo.png"/>
      <hr class="herka">
      <a href="profil.php" class="menu">Profile</a>
      <a href="szukaniegier.php" class="menu">Rooms</a>
      <?php
        require_once "connect.php";

        $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

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
    <main>
      <article class="stworz">
        <section class="tytul">
          <h1>Who is this?</h1>
        </section>
        <section class="polegry">
          Obrazek<br>
          Opcja A 
          Opcja B<br>
          Opcja C
          Opcja D
        </section>
        <section class="gracze">
        <?php
        require_once "connect.php";

        $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
        $nr = mysqli_query($polaczenie,"select pozycja_pokuj from uzytkownicy where login='".$_SESSION['$user']."'");

        $nrpokoju = $nr->fetch_row();

        $ktora = mysqli_query($polaczenie,"select id_gry from gry where p".$nrpokoju[0]."='".$_SESSION['$user']."'");

        $ktoragra = $ktora->fetch_row();

        $ile = mysqli_query($polaczenie,"select ile_graczy from gry where p".$nrpokoju[0]."='".$_SESSION['$user']."'");

        $ilegraczy = $ile->fetch_row();

        for( $a = 1; $a <= $ilegraczy[0]; $a++ ){
          $p1 = mysqli_query($polaczenie,"select p".$a." from gry where id_gry='".$ktoragra[0]."'");

          $p1 = $p1->fetch_row();

          $zdj = mysqli_query($polaczenie,"select zdj from uzytkownicy where login='".$p1[0]."'");

          $zdj = $zdj->fetch_row();

          echo '<section><img class="osoba" src="profilowe/'.$zdj[0].'"/></section>';
          echo '<section class="dane">'.$p1[0].'<br>0</section>';
        }
        $polaczenie->close();
        ?>
        </section>
        <a href="usun.php" class="tytul">Leave</a>
      </article>
    </main>
  </body>
</html>