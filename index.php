<?php require_once 'head.php'; ?>



<div class="tabs" id="tabs_1">
	<ul class="tabs_menu main_tabs_menu">
		<li class="active"><a href="#karts_stats">Топ картов</a></li>
		<li><a href="#pits_info">Питы</a></li>
	</ul>
	<div class="tab_box active info_item" id="karts_stats">
		<div class="hide_title">
			Топ картов
		</div>
		<table id="kt_ronfig1_dry" class="sortable">
			<thead>
				<tr>
					<td>Номер карта</td>
					<td>ЛК</td>
					<td>Кругов</td>
					<td>Последний круг</td>
					<td>Пред последний круг</td>
					<td>Номер команды</td>
					<td>Номер пилота</td>
					<td>Освобится через</td>
				</tr>
			</thead>
			<tbody>
				<?php require_once 'get_karts_stats.php'; ?>
			</tbody>
		</table>
		 <div class="reset_lk button">Сбросить ЛК</div>
	</div>

	<div class="tab_box info_item" id="pits_info">
		<div class="hide_title">
			Питстопы
		</div>
		<table id="pits_info_table">
			<thead>
				<tr>
					<td>Номер карта</td>
					<td>Номер команды</td>
					<td>Номер пилота</td>
					<td>Время до пита</td>
					<td>Сделано питов</td>
					<td></td>

				</tr>
			</thead>
			<tbody>
				<tr>
					<?php require_once "get_pits.php"; ?>
				</tr>
			</tbody>
		</table>
	</div>
<div class="clr">	</div>
</div>

<div class="global_timer">
	<div class="start button">Старт</div>
	<div class="button showwind" data-windowid="settings">Настройки</div>
	
	

<?php 
		$host = 'mexalim.mysql.ukraine.com.ua'; // адрес сервера 
		$database = 'mexalim_karting'; // имя базы данных
		$user = 'mexalim_karting'; // имя пользователя
		$password = 'h857kcpa'; // пароль

		$link = mysqli_connect($host, $user, $password, $database) 
		        or die("Ошибка " . mysqli_error($link));

		$query ="SELECT name_setting,value_setting_time FROM settings ";
		$settings_result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
		//var_dump($teams_result);
		if (!$settings_result) {
		    echo 'Ошибка запроса: ' . mysql_error($link);
		    exit;
		} 

		while ($settings_array = mysqli_fetch_row($settings_result)) {
			$name_setting = $settings_array[0];
			$value_setting_time = $settings_array[1];

			if ($name_setting == 'time_race') {
				echo "<li style='diplay:none;'>";
				if ($value_setting_time != "0000-00-00 00:00:00") {
					$time_start = new DateTime($value_setting_time);
		            $time_now  = new DateTime(date('Y-m-d G:i:s'));
		            $time_different = date_diff($time_now, $time_start);

		            $time_countdown_h = $time_different->h;
		            $time_countdown_i = $time_different->i;
		            $time_countdown_s = $time_different->s;

		            /*переведем все в минуты*/
		            $time_countdown = (24 *60) - (($time_countdown_h * 60) + $time_countdown_i + ($time_countdown_s / 60));


					echo '<div class="timer" data-minutes-left="'.$time_countdown.'"></div>';
				} else {
					echo '<td><div class="timer" data-minutes-left="0"></div></td>';
				}
				echo "</li>";
			}

		}
		
	    mysqli_close($link);
		?>
</div>

<?php require_once 'footer.php'; ?>
</body>
</html>