<?php 
session_start();  

$plik_tmp = $_FILES['plik']['tmp_name']; 
$plik_nazwa = $_FILES['plik']['name']; 
$plik_rozmiar = $_FILES['plik']['size']; 

$a = $_SESSION['$user'].'.jpg';

if(is_uploaded_file($plik_tmp)) { 
    move_uploaded_file($plik_tmp, "profilowe/$a"); 

    header('location: profil.php');
} 
?> 