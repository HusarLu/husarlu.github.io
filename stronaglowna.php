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
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script language="javascript" type="text/javascript">
    var timeout = setInterval(reload, 1500);    
    function reload () {
     $('article.stworz').load('test2.php');
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
        <h1 class="tytul">Rooms: 
        <?php
          echo $_SESSION['ile'];
        ?>
        </h1>
        <?php
          require_once "connect.php";
          $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
          $zapytanie3 = mysqli_query($polaczenie,"select id_gry from gry where runda=0");

          while($wynik = mysqli_fetch_array($zapytanie3)) {  
            echo '<form action="dolacz.php" method="post" class="gry">';
            echo '<input name="id" type="text" class="numerpokoju" readonly value="#'.$wynik["id_gry"].'"/>';
            $zapytanie = mysqli_query($polaczenie,"select p1,p2,p3,p4,p5,p6,p7,p8 from gry where runda=0 and id_gry=".$wynik['id_gry']."");
            $gracze = $zapytanie->fetch_row();
            echo "<p class='gracze'>";
            for( $y = 1; $y <= 8; $y++ ){
              echo $y.".".$gracze[$y-1]."</p>"; 
          } 
          echo "<input type='submit' value='Join' class='tytul'>";
          echo '</form>';
          }
          $polaczenie->close();
        ?>
      </article>
    </main>
  </body>
</html>