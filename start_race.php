<?php 
$host = 'mexalim.mysql.ukraine.com.ua'; // адрес сервера 
$database = 'mexalim_karting'; // имя базы данных
$user = 'mexalim_karting'; // имя пользователя
$password = 'h857kcpa'; // пароль

$link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка " . mysqli_error($link));

$time_start = date('Y-m-d h:i:s'); //Текущая дата


echo $time_start;
/*Добавляем время в настройках*/
    $query ="UPDATE settings SET value_setting_time=now() WHERE name_setting='time_race'";
    $start_race = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    if($start_race)
    {
        
    } else {
        echo "erfer";
    }



/*Добавляем время в питах*/
$query ="UPDATE pitstops SET time_to_pit=now()";
$pitsstop = mysqli_query($link, $query) or die("Ошибка2 " . mysqli_error($link)); 
if($pitsstop)
{
    echo "good";
} else {
    echo "erfer";
}



mysqli_close($link); 


?>