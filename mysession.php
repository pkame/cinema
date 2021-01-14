<?php
session_start();
require_once 'database.php';
require_once 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Кинотеатр. Время сеансов</title>
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <!-- <link rel="stylesheet" href="css/style.css"> -->
  <link rel="stylesheet" href="css/style.css">
  <!-- <script src="slide.js"></script> -->
</head>

<body>
  <div class="container">
    <div class="row header valign-wrapper">
      <div class="col s8">
        <h3>Кинотеатр</h3>
      </div>

      <?php
    $film_name = $_GET['film_name'];
    $film = getFilmByName($film_name);
    ?>
      <?php if (isset($_SESSION['user'])) : ?>
        <div class="col s4">
          <a href="logout.php?path=mysession&film_name=<?=$film_name?>" class="waves-effect waves-light btn right" id="logout-button">
            <i class="material-icons left">account_box</i>
            <span>Выход</span>
          </a>
        </div>
      <?php else : ?>
        <div class="col s2 right">
          <a class="waves-effect waves-light btn" id="login-button">
            <i class="material-icons left">account_box</i>
            <span>Вход</span>
          </a>
        </div>

        <div class="col s3 left">
          <a href="signup.php" class="waves-effect waves-light btn" id="reg-button">
            <i class="material-icons left">account_box</i>
            <span>Регистрация</span>
          </a>
        </div>
      <?php endif; ?>

    </div>

    
    <div class="row">
      <div class="col s3">
        <div class="card">
          <div class="card-image">
            <img src="<?= $film['Img'] ?>" width="90%" alt="">
          </div>
          <div class="card-title"><?= $film['Name'] ?></div>
          <div class="card-content">
            <span>
              <p>Длительность: <?= $film['Duration'] ?> мин</p>
              <p>Жанр: <?= $film['Genre'] ?></p>
              <p>Описание: <?= $film['Description'] ?></p>
            </span>
          </div>
        </div>
      </div>

      <div class="col s8">
        <h3>Расписание показов:</h3>
        <?php
        $film_name = $_GET['film_name'];
        $sessions = getDateByFilmName($film_name);
        ?>
        <?php foreach ($sessions as $session) : ?>
          <div class="row valign-wrapper">
            <div class="col s1"></div>
            <div class="col s11">
              <div class="row">
                <div class="col s8 result-card hoverable">
                  <div class="row">
                    <div class="row">
                      <div class="col s12">
                        <span><?= $session['Date'] ?></span>
                      </div>
                    </div>
                    <div class="row">
                      <?php
                      $times = getTimeByDate($film_name, $session['Date']);
                      foreach ($times as $time) :
                      ?>
                        <div class="col s12">
                          <a class="btn" href="hall.php?time=<?= $time['Time'] ?>&date=<?= $time['Date'] ?>&film=<?= $film_name ?>"><?= $time['Time'] ?></a>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="window-login" id="log-window">
      <div class="col s1">
        <a class="waves-effect waves-light btn" id="close-button2">X</a>
      </div>
      <div class="form">
        <h1>Вход</h1>
        <form action="signin.php?film_name=<?= $film_name?>" method="POST" name="f2">
          <input type='tel' placeholder="Мобильный телефон +7" name="tels" class="input">
          <input type="password" placeholder="Пароль" name="pass" class="input">
          <p></p>
          <p></p>
          <p></p>
          <p></p>
          <p></p>
          <div class="col s1">
            <button class="waves-effect waves-light btn" id="log" type="submit">Войти</button>
          </div>
          <p></p>
          <p></p>
          <p></p>
        </form>
      </div>
    </div>
  </div>
    <script src="./app.js"></script>
    <script src="hall.js"></script>
</body>

<footer class="page-footer blue-grey darken-4">
    <div class="footer-copyright">
        <div class="container">
            <span>© 2021 Copyright Text</span>
        </div>
    </div>
</footer>

</html>