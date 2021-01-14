<?php
    session_start();
    unset($_SESSION['user']);
    $path = $_GET['path'];
    switch($path)
    {
        case 'index':
            header('Location: '.$path.'.php');
            break;
        case 'mysession':
            header('Location: '.$path.'.php?film_name='.$_GET['film_name']);
            break;
        case 'hall':
            header('Location: '.$path.'.php?time='.$_GET['time'].'&date='.$_GET['date'].'&film='.$_GET['film']);
    }
   
?>