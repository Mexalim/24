<?php /*

"objectId": int,     // уникальный идентификатор события с датчика
    "serverTime": int,  // время получения события удаленным сервером в unixtime
    "transponder": int,  //идентификатор датчика
    "secret": int,   // без понятия что это
    "signal": int,  // без понятия что это
    "timestamp": int  // timestamp с датчика до тысячных. но возможно обнуление после какого-то предела...

http://karting.playwar.com/stats.php?fromid=1&toid=30 // получаем отсюда 

transponderId  kart
‎2261324    13
‎2744699  9
‎2758575    69
‎2807865      33
‎4010917   5
‎4078493    21
‎4684020     8
‎4981252     10
‎5901907    4
‎5927164    7
‎5957013     3
‎7181239     2
‎9614994       6
‎9661676    1
*/

$host = 'mexalim.mysql.ukraine.com.ua'; // адрес сервера 
$database = 'mexalim_karting'; // имя базы данных
$user = 'mexalim_karting'; // имя пользователя
$password = 'h857kcpa'; // пароль


$link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка " . mysqli_error($link));


// =============== Пилоты  ================= //

if(isset($_POST['pilot_team']) && isset($_POST['pilot_numer'])){

    $pilot_number = htmlentities(mysqli_real_escape_string($link, $_POST['pilot_numer']));
    $pilot_team = htmlentities(mysqli_real_escape_string($link, $_POST['pilot_team']));
    $pilot_name = htmlentities(mysqli_real_escape_string($link, $_POST['pilot_name']));


    $query ="INSERT INTO pilots VALUES('$pilot_number','$pilot_team','$pilot_name','','')";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 

    if($result)
    {
        header('Location: http://mexalim.com.ua/24/teams.php');
    } else {
        echo "erfer";
    }
    // закрываем подключение
    mysqli_close($link);
}


// =============== Команда  ================= //

if(isset($_POST['team_number']) && isset($_POST['team_name'])){

    $team_number = htmlentities(mysqli_real_escape_string($link, $_POST['team_number']));
    $team_name = htmlentities(mysqli_real_escape_string($link, $_POST['team_name']));

    $query ="INSERT INTO teams VALUES('$team_number','$team_name')";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 

    if($result)
    {   
        $query ="SELECT team_id FROM pitstops WHERE team_id='$team_number'";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 

        if (!$result) {
            echo 'Ошибка запроса: ' . mysql_error();
            exit;
        } 

        $get_team_number = $result->fetch_object()->team_number;

        if ($get_team_number != $team_number) {
             /*Добавляем строку питстопа для команды*/
            $query ="INSERT INTO pitstops VALUES('','$team_number','','','0')";
            $add_pitstop = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
        } 
        
    } else {
        echo "erfer";
    }
    header('Location: http://mexalim.com.ua/24/teams.php');
    // закрываем подключение
    mysqli_close($link);
}

// =============== добавляем время ================= //

if(isset($_POST['kart_number']) && isset($_POST['kart_time'])){

    // экранирования символов для mysql

    $kart_number = htmlentities(mysqli_real_escape_string($link, $_POST['kart_number']));
    $kart_time = htmlentities(mysqli_real_escape_string($link, $_POST['kart_time']));
    $kart_team = htmlentities(mysqli_real_escape_string($link, $_POST['kart_team']));
    $kart_pilot = htmlentities(mysqli_real_escape_string($link, $_POST['kart_pilot']));
    $kart_wether = htmlentities(mysqli_real_escape_string($link, $_POST['kart_wether']));
    $kart_time_end = htmlentities(mysqli_real_escape_string($link, $_POST['kart_time_end']));

     
    // создание строки запроса
    $query ="INSERT INTO karts VALUES('$kart_number','$kart_time','$kart_team','$kart_pilot','$kart_wether','$kart_time_end')";
    // выполняем запрос
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    if($result)
    {
        echo "<span style='color:blue;'>Данные добавлены</span>";
    } else {
        echo "erfer";
    }
    // закрываем подключение
    mysqli_close($link);
}  

if(isset($_POST['kart_real_number'])){
    // подключаемся к серверу


    $kart_real_number = htmlentities(mysqli_real_escape_string($link, $_POST['kart_real_number']));
    $kart_trans = htmlentities(mysqli_real_escape_string($link, $_POST['kart_trans']));

    $query ="INSERT INTO karts VALUES('$kart_real_number','$kart_trans')";
    // выполняем запрос
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    if($result)
    {
        header('Location: http://mexalim.com.ua/24/');
    } else {
        echo "erfer";
    }
    // закрываем подключение
    mysqli_close($link);
}

// =============== Настройки ================= //

if(isset($_POST['wether'])){

    $wether = htmlentities(mysqli_real_escape_string($link, $_POST['wether']));
    $konfig_id = htmlentities(mysqli_real_escape_string($link, $_POST['konfig_id']));

    $query ="UPDATE settings SET value_setting='$wether' WHERE name_setting='wether'";
    $result = mysqli_query($link, $query) or die("Ошибка wether " . mysqli_error($link)); 

    if($result)
    {
        header('Location: http://mexalim.com.ua/24/');
    } else {
        echo "erfer";
    }

    $query ="UPDATE settings SET value_setting='$konfig_id' WHERE name_setting='konfig_id'";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

    if($result)
    {
        header('Location: http://mexalim.com.ua/24/');
    } else {
        echo "erfer";
    }
    // закрываем подключение
    mysqli_close($link);
}


// =============== добавляем питы ================= //



// закрываем подключение
mysqli_close($link);

?>