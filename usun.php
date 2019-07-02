<?php
    
session_start(); 

require_once "connect.php";

$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

if($polaczenie->connect_errno!=0){
    echo "Error:".$polaczenie->connect_errno;
}else{
    
    $zapopozycja = mysqli_query($polaczenie,"select pozycja_pokuj from uzytkownicy where login ='".$_SESSION['$user']."'");

    $nr = mysqli_query($polaczenie,"select pozycja_pokuj from uzytkownicy where login='".$_SESSION['$user']."'");

    $nrpokoju = $nr->fetch_row();

    $pozycja = $zapopozycja->fetch_row();

    $ktora = mysqli_query($polaczenie,"select id_gry from gry where p".$nrpokoju[0]."='".$_SESSION['$user']."'");

    $ktoragra = $ktora->fetch_row();

    $ileosob = mysqli_query($polaczenie,"select ile_graczy from gry where id_gry = '".$ktoragra[0]."'");

    $ile = $ileosob->fetch_row();

    if($nrpokoju[0]==1){

    $zapytanie2 = mysqli_query($polaczenie,"UPDATE `uzytkownicy` SET `status`=0 where `login` = '".$_SESSION['$user']."'");

    $zapytanie3 = mysqli_query($polaczenie,"UPDATE `uzytkownicy` SET `pozycja_pokuj`=0 where `login` = '".$_SESSION['$user']."'");


    for( $x = 2; $x <= 8; $x++ ){

        $kto = mysqli_query($polaczenie,'select p'.$x.' from gry where id_gry='.$ktoragra[0].'');

        $ktonade = $kto->fetch_row();

        $status = mysqli_query($polaczenie,"UPDATE `uzytkownicy` SET `status`=0 where `login` = '".$ktonade[0]."'");

        $pozycja = mysqli_query($polaczenie,"UPDATE `uzytkownicy` SET `pozycja_pokuj`=0 where `login` = '".$ktonade[0]."'");

        $nrpokoju[0]++;
    } 

    $zapytanie3 = mysqli_query($polaczenie,"DELETE FROM `gry` WHERE id_gry=".$ktoragra[0]."");

    header('location: szukaniegier.php');

    }else{

        for( $x = $pozycja[0]+1; $x <= 8; $x++ ){
            $poz = mysqli_query($polaczenie,'select p'.$x.' from gry where p'.$pozycja[0].' = "'.$_SESSION['$user'].'"');

            $pozosoby = $poz->fetch_row();

            $kto = mysqli_query($polaczenie,'select p'.$x.' from gry where id_gry='.$ktoragra[0].'');

            $ktonade = $kto->fetch_row();

            $zapytanie4 = mysqli_query($polaczenie,"UPDATE `gry` SET `p".$nrpokoju[0]."` = '$ktonade[0]' where id_gry=".$ktoragra[0]."");

            $zapytanie5 = mysqli_query($polaczenie,"UPDATE `uzytkownicy` SET `pozycja_pokuj` = '".$nrpokoju."' where login=".$ktonade[0]."");

            $nrpokoju[0]++;
        }  
        $status = mysqli_query($polaczenie,"UPDATE `uzytkownicy` SET `status`=0 where `login` = '".$_SESSION['$user']."'");

        $pozycja = mysqli_query($polaczenie,"UPDATE `uzytkownicy` SET `pozycja_pokuj`=0 where `login` = '".$_SESSION['$user']."'");

        $ileosob = mysqli_query($polaczenie,'select ile_graczy from gry where id_gry = '.$ktoragra[0].'');

        $ileosob2 = $ileosob->fetch_row();

        $ileosob2[0]--;

        $zapytanie5 = mysqli_query($polaczenie,"UPDATE `gry` SET `ile_graczy` = ".$ileosob2[0]." where id_gry=".$ktoragra[0]."");

        $zapytanie6 = mysqli_query($polaczenie,"UPDATE `gry` SET `p8` = '' where id_gry=".$ktoragra[0]."");

        header('location: stronaglowna.php');
    }
}

$polaczenie->close();

?>