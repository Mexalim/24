<?php 

$host = 'mexalim.mysql.ukraine.com.ua'; // адрес сервера 
$database = 'mexalim_karting'; // имя базы данных
$user = 'mexalim_karting'; // имя пользователя
$password = 'h857kcpa'; // пароль

$link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка " . mysqli_error($link));

$get_sevr_api_time_kart = 'true';

$team_id = $_GET['team_id'];
$pit_kart_number = $_GET['pit_kart_number'];
$pit_pilot_number = $_GET['pit_pilot_number'];



if (isset($_GET['pit_kart_number']) || isset($_GET['pit_pilot_number']) || isset($_GET['update_pits']) || isset($_GET['team_id'])) { // Если делаем айкс запрос
  
     if ($get_sevr_api_time_kart == 'true') {
        $query ="SELECT get_time FROM timing WHERE real_kart_number='$team_id'";
        $result = mysqli_query($link, $query) or die("Ошибка d" . mysqli_error($link)); 

        if (!$result) {
            echo 'Ошибка запроса: ' . mysql_error();
            exit;
        } 

       $kart_update_time = $result->fetch_object()->get_time;
       $kart_update_time = gmdate("Y-m-d G:i:s", $kart_update_time);

    } else {
        $kart_update_time = date('Y-m-d G:i:s');
    }


    if (isset($_GET['pit_kart_number'])) {
        /*old kart*/
        $query ="SELECT real_kart_number FROM timing WHERE team_id='$team_id'";
        $old_kart_number = mysqli_query($link, $query) or die("Ошибка d" . mysqli_error($link)); 

        if (!$result) {
            echo 'Ошибка запроса: ' . mysql_error();
            exit;
        } 
 
        $old_kart_number = $old_kart_number->fetch_object()->real_kart_number;

        if ($old_kart_number != '0') { // оЧИСТИЛИ ИНФУ У СТАРОГО КАРТА
            $query ="UPDATE timing SET lost_time='0000-00-00 00:00:00',team_id='0',pilot_id='0' WHERE real_kart_number='$old_kart_number'";
            $result = mysqli_query($link, $query);

            if (!$result) {
                echo 'Ошибка запроса: ' . mysql_error($link);
                exit;
            }
        }
        
        $query ="UPDATE timing SET lost_time='$kart_update_time',team_id='$team_id' WHERE real_kart_number='$pit_kart_number'";
        $result = mysqli_query($link, $query);

        if (!$result) {
            echo 'Ошибка запроса: ' . mysql_error($link);
            exit;
        }

         $query ="UPDATE pitstops SET kart_number='$pit_kart_number' WHERE team_id='$team_id'";
        $result = mysqli_query($link, $query); 

        if (!$result) {
            echo 'Ошибка запроса: ' . mysql_error($link);
            exit;
        }

    }
    if (isset($_GET['pit_pilot_number'])) {
        $query ="UPDATE timing SET lost_time='$kart_update_time',pilot_id='$pit_pilot_number',team_id='$team_id' WHERE real_kart_number='$pit_kart_number'";
        $result = mysqli_query($link, $query);

        if (!$result) {
            echo 'Ошибка запроса: ' . mysql_error($link);
            exit;
        }

         $query ="UPDATE pitstops SET pilot_id='$pit_pilot_number' WHERE team_id='$team_id'";
        $result = mysqli_query($link, $query); 

        if (!$result) {
            echo 'Ошибка запроса: ' . mysql_error($link);
            exit;
        }
    }

    if (isset($_GET['update_pits'])) {

        $pit_team_id = $_GET['team_id'];
        $select_kart = $_GET['kart_id'];
        $select_pilot = $_GET['pilot_id'];
        $number_pit = $_GET['number_pit'];
        $lap_pit = $_GET['lap_pit'];
   
      
        if ($select_pilot != '0') { // Если есть номер пилота то отправляем данные в отчет
          
            $query ="SELECT time_to_pit FROM pitstops WHERE team_id='$team_id'";
            $result = mysqli_query($link, $query) or die("Ошибка 2" . mysqli_error($link)); 
            if (!$result) {  echo 'Ошибка запроса: ' . mysql_error();  exit; } 

            $pilot_start = $result->fetch_object()->time_to_pit; //Получили время когда стартовал отрезок 

            $pilot_start = new DateTime($pilot_start);
            $time_now  = new DateTime(date('Y-m-d G:i:s'));
            $race_part = date_diff($time_now, $pilot_start);


            $race_part_h = $race_part->h;
            $race_part_i = $race_part->i;
            $race_part_s = $race_part->s;

    
         
            /*переведем все в минуты 80*/
            $race_part_min = $race_part->format('%h:%i:%s');

            $query ="SELECT value_setting_time FROM settings WHERE name_setting='time_race'";
            $result = mysqli_query($link, $query) or die("Ошибка 1" . mysqli_error($link)); 
            if (!$result) {  echo 'Ошибка запроса: ' . mysql_error();  exit; } 

            $race_start = $result->fetch_object()->value_setting_time; //Получили время когда стартовал отрезок 
 
            $race_start = new DateTime($race_start);
            $race_start_part = date_diff($time_now, $race_start);

            /*переведем все в минуты 80*/
            $race_start_part = $race_start_part->format('%h:%i:%s');
                
             $query ="UPDATE pilots SET time_in_race= ADDTIME(time_in_race, '$race_part_min')  WHERE pilot_id='$select_pilot' AND team_id='$pit_team_id'";
            $result = mysqli_query($link, $query);

            if (!$result) {
                echo 'Ошибка запрос2: ' . mysql_error($link);
                exit;
            }

             /*Получаем текущее общее время*/
            $query ="SELECT time_in_race FROM pilots WHERE pilot_id='$select_pilot'";
            $result = mysqli_query($link, $query) or die("Ошибка 1" . mysqli_error($link)); 
            if (!$result) {  echo 'Ошибка запроса: ' . mysql_error();  exit; } 

            $pilot_time_in_race = $result->fetch_object()->time_in_race ;
            $pilot_time_in_race = strftime($pilot_time_in_race);


                echo $pilot_time_in_race;
            /*Отправляем данные в отчет*/
            $query ="INSERT INTO report VALUES('$race_start_part','$race_part_min','$select_kart','$lap_pit','$pit_team_id','$select_pilot','$number_pit', '$pilot_time_in_race')";
            $result = mysqli_query($link, $query) or die("Ошибка 0" . mysqli_error($link)); 


            if (!$result) {
                echo 'Ошибка запроса: ' . mysql_error($link);
                exit;
            }

           

        }


        $query ="UPDATE pitstops SET time_to_pit='$kart_update_time',pits_num=pits_num+1 WHERE team_id='$team_id'";
        $result = mysqli_query($link, $query); 
        if (!$result) {
            echo 'Ошибка запроса: ' . mysql_error($link);
            exit;
        }
        

        if ($select_kart != '0') {

            $query ="UPDATE timing SET lost_time='$kart_update_time' WHERE real_kart_number='$select_kart'";
            $result = mysqli_query($link, $query)  or die("Ошибка 0" . mysqli_error($link)); 

            if (!$result) {
                echo 'Ошибка запроса: ' . mysql_error($link);
                exit;
            }
        }

      

    }


}

    $query ="SELECT kart_number,team_id,pilot_id,time_to_pit,pits_num FROM pitstops ";
    $pits_result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    //var_dump($teams_result);

    if (!$pits_result) {
        echo 'Ошибка запроса: ' . mysql_error($link);
        exit;
    } 

    while ($pits_array = mysqli_fetch_row($pits_result)) {
        
        $kart_number = $pits_array[0]; // Номер карта 
        $team_id = $pits_array[1]; // Номер команды
        $pilot_id_now = $pits_array[2]; // Номер пилота
        $time_to_pit = $pits_array[3]; // Время старта отрезка пита
        $pits_num = $pits_array[4]; // Время старта отрезка пита

        echo '<tr id="'.$team_id.'">';
        echo '<td><select name="pit_kart_number" id="form_kart_numbers"><option value="0"></option>';

             /*Показываем список картов*/
             $karts_numbers_array = array( //Расшифровка счетчиков. Массив используется везде
                "1","2","3","4","5","6","7","8","9","10","13","21","33","69"
             );
             foreach ($karts_numbers_array as $karts_numbers_arrays) {
                 if ($kart_number == $karts_numbers_arrays) {
                   echo '<option selected value="'.$karts_numbers_arrays.'">'.$karts_numbers_arrays.'</option>';
                } else {
                   echo '<option value="'.$karts_numbers_arrays.'">'.$karts_numbers_arrays.'</option>';
                }
             }
           
           echo '</select>    </td>';
        echo "<td>".$team_id."</td>";
        echo '<td><select name="pit_pilot_number" id="form_pilot_numbers"><option value="0"></option>';
            /*Получить список пилотов команды*/
            $query = "SELECT pilot_id,name FROM pilots WHERE team_id='$team_id'";
            $pilots_result = mysqli_query($link, $query) or die("Ошибка 33" . mysqli_error($link));  
            //var_dump($teams_result);

            if (!$pilots_result) {
                echo 'Ошибка запроса: ' . mysql_error($link);
                exit;
            } 

            while ($pilots_array = mysqli_fetch_row($pilots_result)) {
                $pilot_id = $pilots_array[0];
                $name = $pilots_array[1];
                if ($pilot_id_now == $pilot_id) {
                   echo '<option selected value="'.$pilot_id.'">'.$pilot_id.' ('.$name.')</option>';
                } else {
                   echo '<option value="'.$pilot_id.'">'.$pilot_id.' ('.$name.')</option>';
                }
                
            }       
        echo '</select></td>';
        if ($time_to_pit == '' || $time_to_pit == '0000-00-00 00:00:00') {
           echo '<td><div class="timer_pits" data-minutes-left="0"></div></td>';
        } else {
           $time_to_pit = new DateTime($time_to_pit);
            $time_now  = new DateTime(date('Y-m-d G:i:s'));
            $time_different = date_diff($time_now, $time_to_pit);

            $time_countdown_h = $time_different->h;
            $time_countdown_i = $time_different->i;
            $time_countdown_s = $time_different->s;

            /*переведем все в минуты 80*/
            $time_countdown = round(80 - (($time_countdown_h * 60) + $time_countdown_i + ($time_countdown_s / 60)));
            if ($time_countdown <= '0') {
                        $time_countdown = '0';
                    }
        
        echo '<td><div class="timer_pits" data-minutes-left="'.$time_countdown.'"></div></td>';
        }
        echo '<td class="number_pit">'.$pits_num.'</td>';
        echo '<td><div class="button green">Пит</div></td>';
        echo '</tr>';

    }

    mysqli_free_result($result);

    mysqli_close($link);
?>