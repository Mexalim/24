<?php require_once 'head.php'; ?>

<div class="tabs" id="tabs_1">
	<div class="tab_box info_item" id="team_pilots">
		<div class="hide_title">
			Отчет по питам
		</div>
		<table>
			<thead>
				<tr>
					<td>Номер пита</td>
					<td>Круг</td>
					<td>Пилот</td>
					<td>Карт</td>
					<td>Общее время гокни</td>
					<td>Отрезок</td>
					<td>Всего у пилота</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<?php 

						$host = 'mexalim.mysql.ukraine.com.ua'; // адрес сервера 
						$database = 'mexalim_karting'; // имя базы данных
						$user = 'mexalim_karting'; // имя пользователя
						$password = 'h857kcpa'; // пароль

						$link = mysqli_connect($host, $user, $password, $database) 
						        or die("Ошибка " . mysqli_error($link));


						     $query ="SELECT pilot_id,name,time_in_race FROM pilots";
						    $pilots_result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 

						    $pilots_array = array();

						    if (!$pilots_result) {
						        echo 'Ошибка запроса: ' . mysql_error($link);
						        exit;
						    } 

						    foreach( $pilots_result as  $pilots_results) {
						        $pilots_array[$pilots_results[pilot_id]] =  array('name' => $pilots_results[name], 'time' => $pilots_results[time_in_race]);
						    }

						    $query ="SELECT race_time, part_time_race, kart_number, lap_pit_number, team_number, pilot_number, number_pit, team_number FROM report ";
						    $report_array = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
			

						    if (!$report_array) {
						        echo 'Ошибка запроса: ' . mysql_error($link);
						        exit;
						    } 

						    foreach($report_array as $report_arrays) {

						        $report_race_time = $report_arrays[race_time]; // Номер карта 
						        $report_part_time_race = $report_arrays[part_time_race]; // Номер команды
						        $report_kart_number = $report_arrays[kart_number]; // Номер пилота
						        $report_lap_pit_number = $report_arrays[lap_pit_number]; // Время старта отрезка пита
						        $report_team_number = $report_arrays[team_number]; // Время старта отрезка пита
						        $report_pit_number = $report_arrays[number_pit]; 
						        $report_pilot_name = $pilots_array[$report_arrays[pilot_number]]['name'];
						        $report_team_number = $report_arrays[team_number]; 
						        $report_pilot_in_race = $pilots_array[$report_arrays[pilot_number]]['time'];


						        if (isset($_GET['team_id'])) {
						           if ($_GET['team_id'] == $report_team_number ) {
						                echo '<tr>';
						                echo '<td>'.$report_pit_number.'</td>';
						                echo '<td>'.$report_lap_pit_number.'</td>';
						                echo '<td>'.$report_pilot_name.'</td>';
						                echo '<td>'.$report_kart_number.'</td>';
						                echo '<td>'.$report_race_time.'</td>';
						                echo '<td>'.$report_part_time_race.'</td>';
						                echo '<td>'.$report_pilot_in_race.'</td>';
						                echo '</tr>';
						           }
						        } else {
						            echo '<tr>';
						            echo '<td>'.$report_pit_number.'</td>';
						            echo '<td>'.$report_lap_pit_number.'</td>';
						            echo '<td>'.$report_pilot_name.'</td>';
						            echo '<td>'.$report_kart_number.'</td>';
						            echo '<td>'.$report_race_time.'</td>';
						            echo '<td>'.$report_part_time_race.'</td>';
						            echo '<td>'.$report_pilot_in_race.'</td>';
						            echo '</tr>';
						        }

						    }

						    mysqli_free_result($result);

						    mysqli_close($link);
						?>
				</tr>
			</tbody>
		</table>
	</div>
</div>

<?php require_once 'footer.php'; ?>