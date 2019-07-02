<?php

        session_start();

        require_once "connect.php";

        $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

        echo '<h1 class="tytul">Rooms: '; 

        $zapytanie = mysqli_query($polaczenie,"select COUNT(id_gry) from gry where runda=0");

        $ile = $zapytanie->fetch_row();

        echo $ile[0];
        echo '</h1>';
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