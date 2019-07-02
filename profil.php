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
    <link rel="stylesheet" type="text/css" href="style/style.css"/>
    <link rel="stylesheet" type="text/css" href="style/style-gry.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  </head>
  <body>
    <nav>
      <img class="logo" src="grafika/logo.png"/>
      <hr class="herka">
      <a href="#" class="menu">Profile</a>
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
        <?php
            require_once "connect.php";

            $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

            echo "<h1 class='tytul'>".$_SESSION['$user']."</h1>";
            
            $obraz = mysqli_query($polaczenie,'select zdj from uzytkownicy where login="'.$_SESSION['$user'].'"');

            $obrazek = $obraz->fetch_row();

            echo "<img class='osoba' src='profilowe/".$_SESSION['$user'].".jpg'/>";

            echo '<form enctype="multipart/form-data" action="dodajzdj.php" method="POST">
                <input name="plik" type="file" /> 
                <input type="submit" value="Wyślij plik" /> 
                </form>';
        ?>  
      </article>
    </main>
  </body>
</html>