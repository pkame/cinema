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
  <title>Выбор мест</title>
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <link rel="stylesheet" href="css/style.css">
</head>

<body class="blue-grey darken-3">
  <div class="container">
    <div class="row header valign-wrapper">
      <div class="col s8">
        <h3>Кинотеатр</h3>
      </div>

      <?php
      $time = $_GET['time'];
      $_SESSION['time'] = $time;
      $date = $_GET['date'];
      $_SESSION['date'] = $date;
      $film_name = $_GET['film'];
      ?>

      <?php if (isset($_SESSION['user'])) : ?>
        <div class="col s4">
          <a href="logout.php?path=hall&time=<?= $time ?>&date=<?= $date ?>&film=<?= $film_name ?>" class="waves-effect waves-light btn right" id="logout-button">
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
    <?php
    $neededhall = getHallByDateAndTime($film_name, $date, $time);
    $_SESSION['hall'] = $neededhall['hallnumber'];
    $hall = getHall($neededhall['hallnumber']);
    $chairs = getTickets($neededhall['hallnumber'], $date, $time);
    $chair = array();
    $cnt = 0;
    $count = 0;
    foreach ($chairs as $e) {
      $chair[$cnt++] = $e['placecode'];
    }
    ?>

    <div class="row valin-wrapper">
      <h2>Выберите места:</h2>
      <h6>Чтобы забронировать билеты, необходимо авторизироваться</h6>
      <p></p>
      <p></p>
      <?php
      $rows = $hall['numrows'];
      $colls = $hall['numplaces'];
      for ($i = 0; $i < $rows; $i++) :
      ?>

        <div class="row valin-wrapper">
          <div class="col s3">
            <span class="right num"><?= $i + 1 ?></span>
          </div>

          <?php
          for ($j = 0; $j < $colls; $j++) :
          ?>
            <?php if ($count < $cnt && checkPlace($chair[$count], $i, $j)) : ?>
              <div class="col s1">
                <div class="btn disabled"><?= $j + 1 ?></div>
              </div>
            <?php $count++;
            else : ?>
              <div class="col s1">
                <div class="btn" onclick="onPlaceClickJS(<?= $i+1?>,<?= $j + 1 ?>)" id="<?= strval($i+1) . strval($j + 1) ?>"><?= $j + 1 ?></div>
              </div>
            <?php endif; ?>
          <?php endfor; ?>

          <div class="col s3">
            <span class="left num"><?= $i + 1 ?></span>
          </div>
        </div>
      <?php endfor; ?>
    </div>

    <div class="row">
      <div class="col s4"></div>
      <div class="col s4">
        <div class="row">
          <div class="col s1">
            <div class="disabled btn">
              <i class="material-icons">close</i>
            </div>
          </div>
          <div class="col s4">
            <h6 class="right-align">- занято</h6>
          </div>
          <div class="col s1">
            <div class=" btn">
              <i class="material-icons">check</i>
            </div>
          </div>
          <div class="col s5">
            <h6 class="right-align">- свободно</h6>
          </div>
        </div>
      </div>
      <div class="col s4"></div>
    </div>

    <div class="row">
      <div class="right-align col s11">
        <a href="" class="waves-effect waves-light btn" id="buy">
          <span>Забронировать</span>
        </a>
      </div>
    </div>

    <div class="window-login" id="log-window">
      <div class="col s1">
        <a class="waves-effect waves-light btn" id="close-button2">X</a>
      </div>
      <div class="form">
        <h1>Вход</h1>
        <form action="signin.php?time=<?= $time ?>&date=<?= $date ?>&film=<?= $film_name ?>" method="POST" name="f1">
          <input type='tel' placeholder="Мобильный телефон +7" name="telh" class="input">
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
    <?php if (!isset($_SESSION['user'])) : ?>
      <script src="hall.js"></script>
    <?php endif; ?>
    <script src="jquery-3.4.1.min.js"></script>
    <script>
       var placeIdArray = new Array();
      
      function onPlaceClickJS(i, j) {
        var ii = i.toString();
        var jj = j.toString();
        var id = ii + jj;
        placeIdArray.push(id);
        document.getElementById(id).style.backgroundColor = "#c9495c";
      }

      $('#buy').click(function(e) {

        $.ajax({
          url: 'buy.php',
          type: 'POST',
          dataType: 'json',
          data: {
            places: placeIdArray
          },
          success(data) {

            if (data.status) {
              document.location.href = 'hall.php?time=<?= $time ?>&date=<?= $date ?>&film=<?= $film_name ?>';
              window.alert(data.message);
            } else {
              window.alert(data.message);
            }

          }
        });

      });
    </script>
</body>

<footer class="page-footer blue-grey darken-4">
    <div class="footer-copyright">
        <div class="container">
            <span>© 2021 Copyright Text</span>
        </div>
    </div>
</footer>

</html>