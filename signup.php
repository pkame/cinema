<?php
    session_start();
    if (isset($_SESSION['user'])) {
        header('Location: index.php');
    }
    require_once 'database.php';

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Кинотеатр</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <!-- <script src="slide.js"></script> -->
</head>

<body>
    
    <div class="window-registration" id="reg-window">
        <div class="col s1">
            <a class="waves-effect waves-light btn" id="close-button1">X</a>
        </div>
        <div class="form">
            <h1>Регистрация</h1>
            <h7>После регистрации выполните вход</h7>
            <form action="registration.php" method="post" name="f1">
                <input type='tel' placeholder="Мобильный телефон +7" name="tel1" class="input">
                <input type="email" placeholder="Емеил" name="email1" class="input">
                <input type="password" placeholder="Пароль" name="pass1" class="input">
                <p></p>
                <p></p>
                <p></p>
                <p></p>
                <p></p>
                <div class="col s1">
                    <button class="waves-effect waves-light btn" name="regBtn" id="reg" type="submit"> Зарегистрироваться </button>
                </div>
                <p></p>
                <p></p>
                <p></p>
                <?php
                    if (isset($_SESSION['msg']))
                    {
                        echo '<span>'.$_SESSION['msg'].'</span>';
                        unset($_SESSION['msg']);
                    }
                ?> 
            </form>
        </div>
  </div>

  <script>document.getElementById("reg-window").style.display ="block";</script>
  <script src="./app.js"></script>
</body>
