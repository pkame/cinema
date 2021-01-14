<?php
    session_start();
    require_once 'database.php';

    // global $link;


    if (isset($_POST['tel1']) && isset($_POST['email1']) && isset($_POST['pass1']) &&
    $_POST['tel1'] > 9000000000 && $_POST['pass1'] != '' && $_POST['email1'] != '') {
        $telephone = intval(trim($_POST['tel1']));
        $email = trim($_POST['email1']);
        $password = md5(trim($_POST['pass1']));
   
        $query = "SELECT Телефон FROM Клиент WHERE Телефон = '$telephone'";
        $result = mysqli_query($link, $query);

        if (mysqli_num_rows($result) == 0) {
            $insert_query = "INSERT INTO Клиент (Телефон, Пароль, `e-mail`) VALUES ('$telephone', '$password', '$email')";
            $result1 = mysqli_query($link, $insert_query);
            if ($result1) {
                $_SESSION['message'] = 'Регистрация прошла успешно';
                header('Location: index.php');
            } else {
                $_SESSION['message'] = 'Ошибка с бд';
                header('Location: error.php');
            }
        } else {
            $_SESSION['message'] = 'Такой пользователь уже существует? выполните вход';
            header('Location: error.php');
        }   
    }
    else {
        $_SESSION['message'] = 'Пожалуйста, заполните все поля';
        header('Location: error.php');
    }
?>