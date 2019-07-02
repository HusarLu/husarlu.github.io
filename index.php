<?php
  session_start();

  if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true)){
    header('Location: stronaglowna.php');
    exit();
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ANIME - QUIZ</title>
    <link rel="stylesheet" type="text/css" href="style/style-log.css"/>
    <script src="js/logowanie.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  </head>
  <body>
    <nav>
      <img class="logo" src="grafika/logo.png"/><br>
      <article>
        <section class="fwybor">
          <input type="submit" value="Sign in" class="wybor logowanie">
          <p>OR</p>
          <input type="submit" value="Sign up" class="wybor rejsetrowanie">
        </section>

        <form class="zaloguj" action="zaloguj.php" method="post">
            <input type="text" placeholder="Username" name="login" class="wybor">
            <input type="password" placeholder="Password" name="haslo" class="wybor">
            <input class="przy" type="submit" name="zaloguj" value="Login"/><br>
            <a class="cofnij">Cancel</a>
        </form>

        <form class="zarejestruj" action="rejestracja.php" method="post">
            <input type="text" placeholder="Username" name="login" class="wybor">
            <input type="password" placeholder="Password" name="haslo" class="wybor">
            <input type="password" placeholder="Confirm password" name="phaslo" class="wybor">
            <input type="text" placeholder="Email" name="email" class="wybor"><br>
            <input class="przy" name="stworz" type="submit" value="Create account"/><br>
            <a class="cofnij">Cancel</a>
        </form>
      </article>
    </nav>
    <main>
      <img class="saitama" src="grafika/saitama.png"/>
      <h1 class="saitama">Welcome to the anime-quiz</h1>
    </main>
  </body>
</html>