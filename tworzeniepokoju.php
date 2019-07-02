<?php
    
    session_start(); 

    require_once "connect.php";

    $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

    if($polaczenie->connect_errno!=0){
        echo "Error:".$polaczenie->connect_errno;
    }else{
        
        $zapytanieostatus = mysqli_query($polaczenie,"select status from uzytkownicy where login='".$_SESSION['$user']."';"); 

        $status = $zapytanieostatus->fetch_row();

        echo $status[0];

        if($status[0] == 1){
            header('Location: stworzgre.php');
        }else{
            $_SESSION['rand'] = rand(100000,999999);

            $zapytanie1 = mysqli_query($polaczenie,"INSERT INTO `gry` (`id_gry`, `ile_graczy`, `p1`) VALUES (".$_SESSION['rand'].", '1', '".$_SESSION['$user']."');");

            $zapytanie2 = mysqli_query($polaczenie,"UPDATE `uzytkownicy` SET `status`=1 where `login` = '".$_SESSION['$user']."'");

            $zapytanie3 = mysqli_query($polaczenie,"UPDATE `uzytkownicy` SET `pozycja_pokuj`=1 where `login` = '".$_SESSION['$user']."'");

            header('Location: stworzgre.php');
        }
    }

    $polaczenie->close();

?>