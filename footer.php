<div class="clr"></div>
<a href="http://mexalim.com.ua/24/" class="button">Главная</a>
<a href="teams.php" class="button">Команды</a>
<a href="report.php?team_id=1" class="button">Отчет</a>
<a href="history.php" class="button">История</a>


<div id="windid_addtimekart" class="pop_window">
	<div class="bw_close"></div>
	<div class="windw_content">
		<div class="window_title">Добавить время карта</div>
			<form action="load.php" id="add_kart_time" method="POST">
				<ul>		
				<li>
					<label for="">Номер карта</label>
					<select name="kart_number" id="form_kart_numbers">
						<?php foreach ($karts_numbers as $key => $value) { 
							echo '<option value="'.$value.'">'.$value.'</option>';
						} ?>
					</select>		
				</li>
				<li>
					<label for="">Время</label>
					<input type="text" name="kart_time" value="">
				</li>
				<li>
					<label for="">Команда</label>
					<select name="kart_team" id="">
						<!-- Выводим имена команд -->
						<option value="">1</option>
						<option value="">33</option>
					</select>	
				</li>
				<li>
					<label for="">Пилот</label>
					<select name="kart_pilot" id="">
						<!-- Показываем имена пилотов в зависимости от выбранной команды -->
						<option value="">1</option>
						<option value="">33</option>
					</select>	
				</li>
				<li>
					<label for="">Погода</label>
					<select name="kart_wether" id="">
						<!-- Показываем имена пилотов в зависимости от выбранной команды -->
						<option value="wet">Мокро</option>
						<option value="mix">Микс</option>
						<option selected value="dry">Сухо</option>
					</select>	
				</li>
				<li>
					<label for="">До конца</label>
					<input type="text" name="kart_time_end" value="">
				</li>
				<button type="submit" class="submit button">
					Добавить время
				</button>
				</ul>
			</form>
	</div>
</div>
<div id="windid_addpilot" class="pop_window">
	<div class="bw_close"></div>
	<div class="windw_content">
		<div class="window_title">Добавить пилота</div>
			<form action="load.php" method="POST" id="add_pilot_form">
				<ul>	
				<li>
					<label for="">Номер команды</label>
					<select name="pilot_team" id="form_kart_numbers">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="13">13</option>
						<option value="21">21</option>
						<option value="33">33</option>
						<option value="69">69</option>
					</select>
				</li>
				<li>
					<label for="">Номер пилота</label>
					<input type="text" name="pilot_numer" value="1">
				</li>
				<li>
					<label for="">Имя пилота</label>
					<input type="text" name="pilot_name" value="">
				</li>
				<button type="submit" class="submit button">
					Добавить пилота
				</button>
				</ul>
			</form>
	</div>
</div>
<div id="windid_addteam" class="pop_window">
	<div class="bw_close"></div>
	<div class="windw_content">
		<div class="window_title">Добавить команду</div>
			<form action="load.php" method="POST" id="add_team_form">
				<ul>	
				<li>
					<label for="">Номер команды (карта)</label>
					<select name="team_number" id="form_kart_numbers">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="13">13</option>
						<option value="21">21</option>
						<option value="33">33</option>
						<option value="69">69</option>
					</select>
				</li>
				<li>
					<label for="">Название команды</label>
					<input type="text" name="team_name" value="">
				</li>
				<button type="submit" class="submit button">
					Добавить команду
				</button>
				</ul>
			</form>
	</div>
</div>

<div id="windid_settings" class="pop_window">
	<div class="bw_close"></div>
	<div class="windw_content">
		
<form action="load.php" id="add_kart_time" method="POST">
		<ul>		

<?php 
		$host = 'mexalim.mysql.ukraine.com.ua'; // адрес сервера 
		$database = 'mexalim_karting'; // имя базы данных
		$user = 'mexalim_karting'; // имя пользователя
		$password = 'h857kcpa'; // пароль

		$link = mysqli_connect($host, $user, $password, $database) 
		        or die("Ошибка " . mysqli_error($link));

		$query ="SELECT name_setting,value_setting,value_setting_time FROM settings ";
		$settings_result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
		//var_dump($teams_result);
		if (!$settings_result) {
		    echo 'Ошибка запроса: ' . mysql_error($link);
		    exit;
		} 
		$wether_array = array("dry","mix","wet");
		$konfig_array = array("1","2","3");

		while ($settings_array = mysqli_fetch_row($settings_result)) {
			$name_setting = $settings_array[0];
			$value_setting = $settings_array[1];
			$value_setting_time = $settings_array[2];
			
			if ($name_setting == 'wether') {
				echo "<li>";
				echo '
					<label for="">Погода</label>
					<select name="wether" id="">';
			         foreach ($wether_array as $wether_arrays) {
			             if ($value_setting == $wether_arrays) {
			               echo '<option selected value="'.$wether_arrays.'">'.$wether_arrays.'</option>';
			            } else {
			               echo '<option value="'.$wether_arrays.'">'.$wether_arrays.'</option>';
			            }
			         }

				echo '
					</select>
				';
				echo "</li>";
			}
			
			
			if ($name_setting == 'konfig_id') {
				echo "<li>";
				echo '
					<label for="">Конфиг</label>
					<select name="konfig_id" id="">';
			         foreach ($konfig_array as $konfig_arrays) {
			             if ($value_setting == $konfig_arrays) {
			               echo '<option selected value="'.$konfig_arrays.'">'.$konfig_arrays.'</option>';
			            } else {
			               echo '<option value="'.$konfig_arrays.'">'.$konfig_arrays.'</option>';
			            }
			         }

				echo '
					</select>
				';
				echo "</li>";
			}
			
			
			if ($name_setting == 'time_race') {
				echo "<li style='diplay:none;'>";
				if ($value_setting_time != "00-00-00 00:00:00") {
					$time_start = new DateTime($value_setting_time);
		            $time_now  = new DateTime(date('Y-m-d G:i:s'));
		            $time_different = date_diff($time_now, $time_start);

		            $time_countdown_h = $time_different->h;
		            $time_countdown_i = $time_different->i;
		            $time_countdown_s = $time_different->s;

		            /*переведем все в минуты*/
		            $time_countdown = round((24 *60) - (($time_countdown_h * 60) + $time_countdown_i + ($time_countdown_s / 60)));


					echo "<div class='race_start_flag'>".$time_countdown."</div>";
				}
				echo "</li>";
			}
			


		}
		

	    mysqli_close($link);
		?>
		</ul>
		<button type="submit">
			Сохранить
		</button>
	</form>
	</div>
</div>