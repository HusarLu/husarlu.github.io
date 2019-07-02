<?php

echo '<h1 class="tytul">Room ';

session_start(); 

require_once "connect.php";

$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

$status = mysqli_query($polaczenie,"select status from uzytkownicy where login ='".$_SESSION['$user']."'");

$status = $status->fetch_row();

if($status[0] == 0){
  include('stronaglowna.php');
  exit;
}

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
  echo '<a href="gra.php" class="tytul">Start</a>';
}

echo '<a href="usun.php" class="tytul">Leave</a>';

$polaczenie->close();
?>