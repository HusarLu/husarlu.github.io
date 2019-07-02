<?php
    session_start();  

    require_once "connect.php";

    $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
    
    if($polaczenie->connect_errno!=0){
        echo "Error:".$polaczenie->connect_errno;
    }else{
        
        $zapytanie = mysqli_query($polaczenie,"select COUNT(id_gry) from gry where runda=0");

        $ile = $zapytanie->fetch_row();

        $_SESSION['ile'] = $ile[0];

        header('location: stronaglowna.php');
    }

    $polaczenie->close();   
?>