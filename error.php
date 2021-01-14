<?php
session_start();

 if (isset($_SESSION['message']))
 {
     echo '<span>'.$_SESSION['message'].'</span>';
     unset($_SESSION['message']);
 }
?>

