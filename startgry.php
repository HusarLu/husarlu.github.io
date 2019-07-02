<?php
    session_start(); 

    require_once "connect.php";

    $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

    $nr = mysqli_query($polaczenie,"select pozycja_pokuj from uzytkownicy where login='".$_SESSION['$user']."'");

    $nrpokoju = $nr->fetch_row();

    $ktora = mysqli_query($polaczenie,"select id_gry from gry where p".$nrpokoju[0]."='".$_SESSION['$user']."'");

    $ktoragra = $ktora->fetch_row();

    $status = mysqli_query($polaczenie,"UPDATE `gry` SET `runda`=1 where id_gry = ".$ktoragra[0]." ");

    header('location: gra.php');
?>