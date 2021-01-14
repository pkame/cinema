<?php 
$link = mysqli_connect('localhost', 'a78294_dbuser', 'YRp2%w=7=t6qYItu', 'a78294_db');

if(mysqli_connect_errno())
{
    echo mysqli_connect_errno().' '.mysqli_connect_error();
    exit();
}
?>