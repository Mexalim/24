<?php 
$host = 'mexalim.mysql.ukraine.com.ua'; // адрес сервера 
$database = 'mexalim_karting'; // имя базы данных
$user = 'mexalim_karting'; // имя пользователя
$password = 'h857kcpa'; // пароль

$link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка " . mysqli_error($link));

if (isset($_GET[clear_settings])) {
   /*Добавляем ноль в настройки*/
    $query ="UPDATE settings SET value_setting_time='0' WHERE name_setting='time_race'";
    $clear_settring = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    if($clear_settring)
    {
         echo "good";
    } else {
        echo "erfer";
    }
}
if (isset($_GET[clear_pits])) {
    $query ="DELETE FROM pitstops";
    $clear_pit = mysqli_query($link, $query) or die("Ошибка1 " . mysqli_error($link)); 
    if($clear_pit)
    {
        echo "good";
    } else {
        echo "erfer";
    }
    mysqli_close($link); 
}
if (isset($_GET[clear_teams])) {
    $query ="DELETE FROM teams";
    $clear_teams = mysqli_query($link, $query) or die("Ошибка2 " . mysqli_error($link)); 
    if($clear_teams)
    {
        echo "good";
    } else {
        echo "erfer";
    }
    mysqli_close($link); 
}
if (isset($_GET[clear_pilots])) {
    $query ="DELETE FROM pilots";
    $clear_pilots = mysqli_query($link, $query) or die("Ошибка3 " . mysqli_error($link)); 
    if($clear_pilots)
    {
        echo "good";
    } else {
        echo "erfer";
    }
    mysqli_close($link); 
}
if (isset($_GET[clear_report])) {
    $query ="DELETE FROM report";
    $clear_pilots = mysqli_query($link, $query) or die("Ошибка3 " . mysqli_error($link)); 
    if($clear_pilots)
    {
        echo "good";
    } else {
        echo "erfer";
    }
    mysqli_close($link); 
}
if (isset($_GET[clear_timing])) {
    $query ="UPDATE timing SET pilot_id='0',team_id='0',lost_time='0000-00-00 00:00:00'";
    $clear_timng = mysqli_query($link, $query) or die("Ошибка3 " . mysqli_error($link)); 
    if($clear_timng)
    {
        echo "good";
    } else {
        echo "erfer";
    }
    mysqli_close($link); 
}
if (isset($_GET[clear_history])) {
    $query ="DELETE FROM timing_hostory";
    $clear_history = mysqli_query($link, $query) or die("Ошибка3 " . mysqli_error($link)); 
    if($cclear_history)
    {
        echo "good";
    } else {
        echo "erfer";
    }
    mysqli_close($link); 
}
/*Чистим таблицу команд*/

/*Чистим таблицу пилотов*/
?>