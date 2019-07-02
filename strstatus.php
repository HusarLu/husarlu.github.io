<?php

session_start(); 

require_once "connect.php";

$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

$status = mysqli_query($polaczenie,"select status from uzytkownicy where login ='".$_SESSION['$user']."'");

$status = $status->fetch_row();

if($status[0] == 0){
    echo '<h1 class="tytul">EXIST</h1>';
}else{
    header('location: test.php');
}
$polaczenie->close();
?>