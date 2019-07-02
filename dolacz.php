<?php
    session_start(); 
    
    require_once "connect.php";
    
    $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
    
    if($polaczenie->connect_errno!=0){
        echo "Error:".$polaczenie->connect_errno;
    }else{
        $zapytanie1 = mysqli_query($polaczenie,"select status from uzytkownicy where login='".$_SESSION['$user']."'");
        
        $status = $zapytanie1->fetch_row();

        if($status[0] == 0){

            $idgry=$_POST['id'];

            $idgry = substr($idgry, 1, 6);

            $zapytanie2 = mysqli_query($polaczenie,"select ile_graczy from gry where id_gry='".$idgry."'");

            $ilegraczy = $zapytanie2->fetch_row();

            $ilegraczy = $ilegraczy[0];

            $ilegraczy++;

            $dodawaniedobazy = mysqli_query($polaczenie,"UPDATE `gry` SET `p".$ilegraczy."`='".$_SESSION['$user']."' where `id_gry` = '".$idgry."'");

            $dodawaniedobazy2 = mysqli_query($polaczenie,"UPDATE `gry` SET `ile_graczy`='".$ilegraczy."' where `id_gry` = '".$idgry."'");

            $zmianastatusu = mysqli_query($polaczenie,"UPDATE `uzytkownicy` SET `status`=1 where `login` = '".$_SESSION['$user']."'");

            $zmianapozycji = mysqli_query($polaczenie,"UPDATE `uzytkownicy` SET `pozycja_pokuj`= '".$ilegraczy."' where `login` = '".$_SESSION['$user']."'");
            
            header('location: stworzgre.php');
        }else{
            echo "You have room";
        }
    }
    
    $polaczenie->close();
    
    ?>