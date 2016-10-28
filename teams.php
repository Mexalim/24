<?php require_once 'head.php'; ?>

<div class="tabs" id="tabs_1">
	<div class="tab_box info_item" id="teams_info">
		<div class="hide_title">
			База пилотов команд
		</div>
		<?php 

			$host = 'mexalim.mysql.ukraine.com.ua'; // адрес сервера 
			$database = 'mexalim_karting'; // имя базы данных
			$user = 'mexalim_karting'; // имя пользователя
			$password = 'h857kcpa'; // пароль

			$link = mysqli_connect($host, $user, $password, $database) 
			        or die("Ошибка " . mysqli_error($link));

			$query ="SELECT number,name FROM teams ";
			$teams_result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
			//var_dump($teams_result);

			if (!$teams_result) {
			    echo 'Ошибка запроса: ' . mysql_error($link);
			    exit;
			} 

			while ($teams_array = mysqli_fetch_row($teams_result)) {
			    
			    $team_id = $teams_array[0]; // Получили время записи на удаленном сервере
			    $team_name = $teams_array[1]; // Получили старый последний круг

			    echo '<div class="ti_box"><div class="ti_b_name">'.$team_name.'('.$team_id.')</div>';

			    $query = "SELECT pilot_id,name,time_in_race FROM pilots WHERE team_id='$team_id'";
			    $pilots_result = mysqli_query($link, $query) or die("Ошибка 33" . mysqli_error($link)); 

			    echo '<table id="pilots_table">
			                <thead>
			                    <tr>
			                        <td>номер пилота</td>
			                        <td>имя пилота</td>
			                    </tr>
			                </thead>
			                <tbody>
			                    ';
			    while ($pilots_array = mysqli_fetch_row($pilots_result)) {
			        $pilot_id = $pilots_array[0];
			        $name = $pilots_array[1];
			        $time_in_race = $pilots_array[2];

			        echo "<tr><td>".$pilot_id."</td><td>".$name."</td></tr>";
			    }
			    echo '</tbody></table></div>';

			}

			mysqli_free_result($result);

			mysqli_close($link);

			?>

		<div class="clr">	</div>
		<div class="button addteam showwind" data-windowid="addteam">добавить комманду</div>
		<div class="button addpilot showwind" data-windowid="addpilot">добавить пилота</div>
	</div>
</div>

<?php require_once 'footer.php'; ?>