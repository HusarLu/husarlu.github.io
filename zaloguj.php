<?php
    session_start();  
    
    if((!isset($_POST['login'])) || (!isset($_POST['haslo']))){
        header('location: index.php');
        exit();
    }

    require_once "connect.php";

    $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

    if($polaczenie->connect_errno!=0){
        echo "Error:".$polaczenie->connect_errno;
    }else{
        $login = $_POST['login'];
        $haslo = $_POST['haslo'];

        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
        $haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");

        

        if($rezultat = @$polaczenie->query(sprintf("select * from uzytkownicy where BINARY  login='%s' and BINARY haslo='%s'",mysqli_real_escape_string($polaczenie,$login),mysqli_real_escape_string($polaczenie,$haslo)))){
            $ile_userow = $rezultat->num_rows;
            if($ile_userow>0){
                $_SESSION['zalogowany'] = true;

                $wiersz = $rezultat->fetch_assoc();

                $_SESSION['id'] = $wiersz['id'];
                $_SESSION['$user'] = $wiersz['login'];

                $rezultat->close();
                header('Location: szukaniegier.php');

            }else{
                
                $_SESSION['blad'] = "Nie prawidłowy login lub haslo!";

                header('Location: logowanie.php');

            }
        }

        $polaczenie->close();
    }

?>