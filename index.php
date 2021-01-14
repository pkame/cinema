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
    <title>Кинотеатр</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
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

            <?php if (isset($_SESSION['user'])) : ?>
                <div class="col s4">
                    <a href="logout.php?path=index" class="waves-effect waves-light btn right" id="logout-button">
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
        $films = getFilm();
        ?>
        <div class="row cont">
            <?php foreach ($films as $film) : ?>
                <div class="col s4">
                    <div class="card large hoverable">
                        <div class="card-image">
                            <img src="<?= $film['Img'] ?>" alt="">
                        </div>
                        <div class="card-content">
                            <span class="card-title"><?= $film['Name'] ?></span>
                            <div class="row">
                                <div class="col s10"><?= $film['Format'] ?></div>
                                <div class="col s2">
                                    <span><?= $film['AgeLimit'] . '+' ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <a href="mysession.php?film_name=<?= $film['Name'] ?>">Посмотреть сеансы</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="window-login" id="log-window">
            <div class="col s1">
                <a class="waves-effect waves-light btn" id="close-button2">X</a>
            </div>
            <div class="form">
                <h1>Вход</h1>
                <form action="signin.php" method="POST" name="f1">
                    <input type='tel' placeholder="Мобильный телефон +7" name="teli" class="input">
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
    <script>
        document.getElementById("close-button2").addEventListener("click", onCloseButtonClick);

        function onCloseButtonClick() {
            document.getElementById("log-window").style.display = "none";
        }
    </script>
</body>

<footer class="page-footer blue-grey darken-4">
    <div class="footer-copyright">
        <div class="container">
            <span>©2021 Copyright Text</span>
        </div>
    </div>
</footer>

</html>