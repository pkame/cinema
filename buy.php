<?php
    session_start();
    require_once 'database.php';

    $time = $_SESSION['time'];
    $date = $_SESSION['date'];
    $hall = $_SESSION['hall'];
    $placesId = $_POST['places'];
    $response;

    if(isset($_SESSION['user']))
    {
        $login = intval($_SESSION['user']['id']);

        foreach($placesId as $id)
        {
            $place = intval($id) % 10;
            $row = (intval($id) - $place) / 10;

            global $link;

            $sqlplace = "SELECT MAX(placecode) FROM chair";
            $result1 = mysqli_query($link, $sqlplace);
            $placenum = mysqli_fetch_assoc($result1);
            $placenum = $placenum['MAX(placecode)'] + 1;

            $sql = "INSERT INTO chair (placecode, placenumber, placerow, status) VALUES ($placenum, $place, $row, 'Занято')";
            $result1 = mysqli_query($link, $sql);

            if(!$result1)
            {
                $response = [
                    "status" => false,
                    "type" => 1,
                    "message" => "Не удалось создать место"
                ];
            }
            else 
            {
                $sqltn = "SELECT MAX(ticketnumber) FROM bilet";
                $result1 = mysqli_query($link, $sqltn);
                $tn = mysqli_fetch_assoc($result1);
                $tn = $tn['MAX(ticketnumber)'] + 1;
    
                $sqlticket = "INSERT INTO bilet (ticketnumber, placecode, hallnumber, date, time, Телефон, price) VALUES ('$tn', '$placenum', '$hall', '$date', '$time', '$login', 250)";
                $result1 = mysqli_query($link, $sqlticket);
                if(!$result1)
                {
                    $response = [
                        "status" => false,
                        "type" => 1,
                        "message" => "Не удалось забронировать билет"
                    ];
                }
                else
                {
                    $response = [
                        "status" => true,
                        "type" => $tn,
                        "message" => "Ваши билеты успешно забронированы. Назовите номер в кассе: ".$tn
                    ];
                }
            }
           
        }
    }
    else
    {
        $response = [
            "status" => false,
            "type" => 1,
            "message" => "Зарегистрируйтесь или войдите в систему!"
        ];
    
    }
    

    echo json_encode($response);
    if(!$response['status'])
    {
        die();
    }
    

?>

