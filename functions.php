<?php

function getFilm()
{
    global $link;

    $sql = "SELECT * FROM film";
    $result = mysqli_query($link, $sql);
    $films = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $films;
}

function getFilmByName($film_name)
{
    global $link;

    $sql = "SELECT * FROM film WHERE Name = '$film_name'";
    $result = mysqli_query($link, $sql);
    $film = mysqli_fetch_assoc($result);

    return $film;
}

function getDateByFilmName($film_name)
{
    global $link;

    $sql = "SELECT DISTINCT Date FROM demonstration WHERE Name = '$film_name' ORDER BY Date";
    $result = mysqli_query($link, $sql);
    $date = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $date;
}

function getTimeByDate($film_name, $date)
{
    global $link;

    $sql = "SELECT * FROM demonstration WHERE Name = '$film_name' AND Date = '$date' ORDER BY Time";
    $result = mysqli_query($link, $sql);
    $time = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $time;
}

function getHall($hall)
{
    global $link;

    $sql = "SELECT * FROM hall WHERE hallnumber = '$hall'";
    $result = mysqli_query($link, $sql);
    $hall = mysqli_fetch_assoc($result);

    return $hall;
}

function getHallByDateAndTime($film_name, $date, $time)
{
    global $link;

    $sql = "SELECT * FROM demonstration WHERE Name = '$film_name' AND Date = '$date' AND Time = '$time'";
    $result = mysqli_query($link, $sql);
    $res = mysqli_fetch_assoc($result);

    return $res;
}

function getTickets($hall, $date, $time)
{
    global $link;

    $sql = "SELECT p.placecode FROM `bilet` p INNER JOIN `chair` ps ON ps.placecode = p.placecode 
    WHERE hallnumber = '$hall' AND date = '$date' AND time = '$time' ORDER BY ps.placerow ASC, ps.placenumber ASC";
    $result = mysqli_query($link, $sql);
    $tickets = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $tickets;
}

function checkPlace($chair, $i, $j)
{
    global $link;

    $sql = "SELECT * FROM chair WHERE placecode = '$chair'";
    $result = mysqli_query($link, $sql);
    $res = mysqli_fetch_assoc($result);

    if ($res['placenumber'] == ++$j && $res['placerow'] == ++$i)
    {
        return true;
    }
    else return false;
}


?>