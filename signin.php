<?php
    session_start();
    require_once 'database.php';

    global $link;

    if(isset($_POST['teli']))
    {
        $path = 1;
        $login = $_POST['teli'];
    }
    elseif (isset($_POST['tels']))
    {
        $path = 2;
        $login = $_POST['tels'];
        $film = $_GET['film_name'];
    }
    elseif (isset($_POST['telh']))
    {
        $path = 3;
        $login = $_POST['telh'];
        $time = $_GET['time'];
        $date = $_GET['date'];
        $film_name = $_GET['film'];
    }

    $password = md5(trim($_POST['pass']));

    $check_user = mysqli_query($link, "SELECT * FROM Клиент WHERE Телефон = '$login' AND Пароль = '$password'");
    if (mysqli_num_rows($check_user) > 0) {

        $user = mysqli_fetch_assoc($check_user);

        $_SESSION['user'] = [
            "id" => $user['Телефон'],
        ];

        switch($path)
        {
            case 1:
                header('Location: index.php');
                break;
            case 2:
                header('Location: mysession.php?film_name='.$film);
                break;
            case 3:
                header('Location: hall.php?time='.$time.'&date='.$date.'&film='.$film_name);
                break;
        }
        

    } else {
        $_SESSION['message'] = 'Не верный логин или пароль';
        header('Location: error.php');
    }
?>