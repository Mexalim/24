<?php 

$host = 'mexalim.mysql.ukraine.com.ua'; // адрес сервера 
$database = 'mexalim_karting'; // имя базы данных
$user = 'mexalim_karting'; // имя пользователя
$password = 'h857kcpa'; // пароль


$func = $_GET["func"];
$up_from_id = 'false'; // Повышать fromid при каждом запросе на 1 если нет то будеь 4800


$link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка " . mysqli_error($link));



if ($up_from_id == 'true') {
    $query ="SELECT name_setting,value_setting FROM settings WHERE name_setting='fromid'";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    if (!$result) {  echo 'Ошибка запроса: ' . mysql_error();  exit; } 

    $fromid = $result->fetch_object()->value_setting; //Начальный айди запроса
      
    $query ="UPDATE settings SET value_setting=value_setting+1 WHERE name_setting='fromid'";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    if (!$result) {  echo 'Ошибка запроса: ' . mysql_error();  exit; } 
} else {
    $fromid = '4400';
}

/**/
$get_timing = file_get_contents("http://karting.playwar.com/stats.php?fromid=".$fromid."&toid=4800");
$get_timing = file_get_contents("http://karting.playwar.com/livejson.php");

$get_timing = json_decode($get_timing, true);
/**/

if (!$get_timing) {
    echo "Запрос не дал результатат";
    exit();
}

                                                                                                
usort($get_timing[data], function($a, $b) { //Sort the array using a user defined function
    return $a['Best Lap'] < $b['Best Lap'] ? -1 : 1; //Compare the scores
});              


$query ="SELECT time_to_pit,kart_number,pilot_id,team_id,pits_num FROM pitstops";
$get_pitstops = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
if (!$get_pitstops) { echo 'Ошибка запроса: ' . mysql_error($link);    exit;} 

$get_pitstops_array = array();

foreach($get_pitstops as  $get_pitstopss) {
    $get_pitstops_array[$get_pitstopss[kart_number]] =  array('time_to_pit' => $get_pitstopss[time_to_pit], 'team_id' => $get_pitstopss[team_id], 'pilot_id' => $get_pitstopss[pilot_id], 'pits_num' => $get_pitstopss[pits_num]);
}


$query ="SELECT last_lap,best_lap,transponder_id,pilot_id,team_id,laps,real_kart_number FROM timing";
$get_timing_db = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
if (!$get_pitstops) { echo 'Ошибка запроса: ' . mysql_error($link);    exit;} 

$get_timing_db_array = array();

foreach($get_timing_db as  $get_timing_dbs) {
    $get_timing_db_array[$get_timing_dbs[transponder_id]] =  array(
        'best_lap' => $get_timing_dbs[best_lap],
        'last_lap' => $get_timing_dbs[last_lap],
        'team_id' => $get_timing_dbs[team_id],
        'team_id' => $get_timing_dbs[team_id],
        'laps' => $get_timing_dbs[laps],
        'last_lap' => $get_timing_dbs[last_lap],
        'real_kart_number' => $get_timing_dbs[real_kart_number],
        
        );
}


$query = "SELECT number,name FROM teams";
$teams_result = mysqli_query($link, $query) or die("Ошибка 33" . mysqli_error($link));  
if (!$teams_result) { echo 'Ошибка запроса: ' . mysql_error($link);    exit;} 

$teams_result_array = array();
foreach($teams_result as  $teams_results) {
    $teams_result_array[$teams_results[number]] =  array('name' => $teams_results[name]);
}


//exit();

foreach($get_timing[data] as $get_timings) {
    
    $get_timings_kart_real_number = $get_timings['Kart'];
    $get_timings_team_name = $get_timings['Name'];
    $get_timings_last_lap = $get_timings['Last Lap'];
    $get_timings_pre_last_lap = $get_timings['Previous'];
    $get_timings_best_lap = $get_timings['Best Lap'];
    $get_timings_best_after_pit = $get_timings['Best Lap After Pit'];
    $get_timings_avg_lap_after_pit = $get_timings['Avg Lap After Pit'];
    $get_timings_avg_lap = $get_timings['Avg Lap'];
    $get_timings_lap_count = $get_timings['Lap Count'];
    $get_timings_pit_count = $get_timings['Pit Count'];
    $get_timings_update_date = $get_timings['UpdatedDate'];
    $get_timings_pit_date = $get_timings['PitDate'];
    $get_timings_las_timestamp = $get_timings['LastTimestamp'];
    $get_timings_transponder_id = $get_timings['TransponderId'];

//var_dump($get_timings);

    $last_old_lap = $get_timing_db_array[$get_timings_transponder_id]['last_lap'];
    $best_old_lap = $get_timing_db_array[$get_timings_transponder_id]['best_lap'];

    $pilot_id_old = $get_timing_db_array[$get_timings_transponder_id]['pilot_id'];
    $team_id_old = $get_timing_db_array[$get_timings_transponder_id]['team_id'];
    $laps_old = $get_timing_db_array[$get_timings_transponder_id]['laps'];
    $real_kart_number_old = $get_timing_db_array[$get_timings_transponder_id]['real_kart_number'];

    if ($get_timings_last_lap <= $best_old_lap || $get_timings_last_lap == 0) {
        $best_lap_new = $get_timings_last_lap;

        $query ="INSERT INTO timing_hostory VALUES('$get_timings_transponder_id','','$last_old_lap','','$best_old_lap','$real_kart_number_old','','$pilot_id_old','$team_id_old','','','','$laps_old')";
            $result = mysqli_query($link, $query) or die("Ошибка 0" . mysqli_error($link)); 
            if (!$result) {
                echo 'Ошибка запроса: ' . mysql_error($link);
                exit;
            }

        
    } else {
        if ($best_old_lap != '0' && $best_old_lap != '') {
            $best_lap_new = $best_old_lap;
        } else {
            $best_lap_new = $get_timings_last_lap;
        }
        
    }
  //  $lost_time = $pilots_array[$report_arrays[pilot_number]]['time_to_pit'];


    $query ="UPDATE timing SET get_time='$get_timings_update_date', last_lap='$get_timings_last_lap', lsat_2_lap='$get_timings_pre_last_lap', best_lap='$best_lap_new', transponder_time='$get_timings_las_timestamp', track_konfig='1', wather='dry',laps='$get_timings_lap_count' WHERE transponder_id='$get_timings_transponder_id'";

/*
    if ($timestamp != $trans_last_time) {
       $query ="UPDATE timing SET get_time='$serverTime', last_lap='$get_cirl_time', lsat_2_lap='$trans_last_lap', best_lap='$new_best_lap', transponder_time='$timestamp', lost_time='$lost_time', track_konfig='$konfig_id_now', wather='$wather_now' WHERE transponder_id='$transponder'";
    } else {
        $query ="UPDATE timing SET get_time='$serverTime', last_lap='$get_cirl_time', lsat_2_lap='$trans_last_lap', best_lap='$new_best_lap', transponder_time='$timestamp', lost_time='$lost_time', track_konfig='$konfig_id_now', wather='$wather_now',laps=laps+1 WHERE transponder_id='$transponder'";
    }*/

    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
//var_dump($result);
    if (!$result) {
        echo 'Ошибка запроса: ' . mysql_error($link);
        exit;
    }
}

if (isset($_GET['reset_lk'])) {
    $query ="UPDATE timing SET best_lap='0'";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
//var_dump($result);
    if (!$result) {
        echo 'Ошибка запроса: ' . mysql_error($link);
        exit;
    }

}


$query ="SELECT last_lap,lsat_2_lap,best_lap,real_kart_number,pilot_id,team_id,lost_time,laps,wather,track_konfig,get_time FROM timing";
$karts_base = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

if($karts_base) {  

        $rows = mysqli_num_rows($karts_base); // количество полученных строк

        foreach ($karts_base as $karts_bases)
        {
            $f_get_time = gmdate("Y-m-d G:i:s", $karts_bases[get_time]);
    

            if ($show_hint == 'true') {
                echo '<tr class="show_hint" id="'.$karts_bases[real_kart_number].'">';
            } else {
                echo '<tr id="'.$karts_bases[real_kart_number].'" data-time-get="'.$f_get_time.'">';
            }
                echo "<td>".$karts_bases[real_kart_number]."</td>";
                echo "<td>".$karts_bases[best_lap]."</td>";
                echo "<td class='timing_laps'>".$karts_bases[laps]."</td>";
                echo "<td>".$karts_bases[last_lap]."</td>";;
                echo "<td>".$karts_bases[lsat_2_lap]."</td>";

               echo '<td>'.$karts_bases[team_id].'('.$teams_result_array[$karts_bases[team_id]][name].')</td>';
               echo '<td>'.$karts_bases[pilot_id].'</td>';

                echo "<td>";
                if ($karts_bases[lost_time] != "0000-00-00 00:00:00") {
                    # code...
                
                $time_start = new DateTime($karts_bases[lost_time]);
                    $time_now  = new DateTime(date('Y-m-d G:i:s'));
                    $time_different = date_diff($time_now, $time_start);

                    $time_countdown_h = $time_different->h;
                    $time_countdown_i = $time_different->i;
                    $time_countdown_s = $time_different->s;

                    /*переведем все в минуты*/
                    $time_countdown = 80 - (($time_countdown_h * 60) + $time_countdown_i + ($time_countdown_s / 60));
                    if ($time_countdown <= '0') {
                        $time_countdown = '0';
                    }

                    echo '<div class="timer_kart" data-minutes-left="'.$time_countdown.'"></div>';
                } else {
                    echo '<div class="timer_kart" data-minutes-left="0"></div>';
                }
                echo "</td>";
              //  echo "<td>".$f_get_time."</td>";
            echo "</tr>";

        }
        mysqli_free_result($result);
}

mysqli_close($link);

?>