<?php require_once 'head.php'; ?>
<?php 

						$host = 'mexalim.mysql.ukraine.com.ua'; // адрес сервера 
						$database = 'mexalim_karting'; // имя базы данных
						$user = 'mexalim_karting'; // имя пользователя
						$password = 'h857kcpa'; // пароль

						$link = mysqli_connect($host, $user, $password, $database) 
						        or die("Ошибка " . mysqli_error($link));


						
$query ="SELECT last_lap,lsat_2_lap,best_lap,real_kart_number,pilot_id,team_id,lost_time,laps,wather,track_konfig,get_time FROM timing_hostory";
$karts_base = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

$get_karts_array = array();

foreach($karts_base as  $karts_bases) {
    $get_karts_array[$karts_bases[real_kart_number]] =  array('last_lap' => $karts_bases[last_lap], 'best_lap' => $karts_bases[best_lap], 'pilot_id' => $karts_bases[pilot_id], 'team_id' => $karts_bases[team_id], 'laps' => $karts_bases[laps]);
}
?>

<div class="tabs" id="tabs_1">
	<ul class="tabs_menu history_tabs_menu">
		<li ><a href="#box_hist_1" class="active">Карт 1</a></li>
		<li><a href="#box_hist_2">Карт 2</a></li>
		<li><a href="#box_hist_3">Карт 3</a></li>
		<li><a href="#box_hist_4">Карт 4</a></li>
		<li><a href="#box_hist_5">Карт 5</a></li>
		<li><a href="#box_hist_6">Карт 6</a></li>
		<li><a href="#box_hist_7">Карт 7</a></li>
		<li><a href="#box_hist_8">Карт 8</a></li>
		<li><a href="#box_hist_9">Карт 9</a></li>
		<li><a href="#box_hist_10">Карт 10</a></li>
		<li><a href="#box_hist_13">Карт 13</a></li>
		<li><a href="#box_hist_21">Карт 21</a></li>
		<li><a href="#box_hist_33">Карт 33</a></li>
		<li><a href="#box_hist_69">Карт 69</a></li>
	</ul>
		<div class="history_title">
			История
		</div>
		<div class="history_tables active" id="box_hist_1">	
		<div class="history_tables_name">Карт 1</div>
		<table>
			<thead>
				<tr>
					<td>ЛК</td>
					<td>Последний круг</td>
					<td>Круг</td>
					<td>Номер команды</td>
					<td>Номер пилота</td>
				</tr>
			</thead>
			<tbody>
				<tr>
		<?php		
	//Ищем


	foreach($get_karts_array as  $key => $item) {
		if ($key == '1') {
			echo "<td>".$item[best_lap]."</td>";
			echo "<td>".$item[last_lap]."</td>";
			echo "<td>".$item[laps]."</td>";
			echo "<td>".$item[team_id]."</td>";
			echo "<td>".$item[pilot_id]."</td>";
		}
	}
	?>
	</tr>
	</tbody>
	</table>
	</div>
	<div class="history_tables" id="box_hist_2">	
		<div class="history_tables_name">Карт 2</div>
		<table>
			<thead>
				<tr>
					<td>ЛК</td>
					<td>Последний круг</td>
					<td>Круг</td>
					<td>Номер команды</td>
					<td>Номер пилота</td>
				</tr>
			</thead>
			<tbody>
				<tr>
		<?php		
	//Ищем


	foreach($get_karts_array as  $key => $item) {
		if ($key == '2') {
			echo "<td>".$item[best_lap]."</td>";
			echo "<td>".$item[last_lap]."</td>";
			echo "<td>".$item[laps]."</td>";
			echo "<td>".$item[team_id]."</td>";
			echo "<td>".$item[pilot_id]."</td>";
		}
	}
	?>
	</tr>
	</tbody>
	</table>
	</div>
	<div class="history_tables" id="box_hist_3">	
		<div class="history_tables_name">Карт 3</div>
		<table>
			<thead>
				<tr>
					<td>ЛК</td>
					<td>Последний круг</td>
					<td>Круг</td>
					<td>Номер команды</td>
					<td>Номер пилота</td>
				</tr>
			</thead>
			<tbody>
				<tr>
		<?php		
	//Ищем


	foreach($get_karts_array as  $key => $item) {
		if ($key == '3') {
			echo "<td>".$item[best_lap]."</td>";
			echo "<td>".$item[last_lap]."</td>";
			echo "<td>".$item[laps]."</td>";
			echo "<td>".$item[team_id]."</td>";
			echo "<td>".$item[pilot_id]."</td>";
		}
	}
	?>
	</tr>
	</tbody>
	</table>
	</div>

	<div class="history_tables" id="box_hist_4">	
		<div class="history_tables_name">Карт 4</div>
		<table>
			<thead>
				<tr>
					<td>ЛК</td>
					<td>Последний круг</td>
					<td>Круг</td>
					<td>Номер команды</td>
					<td>Номер пилота</td>
				</tr>
			</thead>
			<tbody>
				<tr>
		<?php		
	//Ищем


	foreach($get_karts_array as  $key => $item) {
		if ($key == '4') {
			echo "<td>".$item[best_lap]."</td>";
			echo "<td>".$item[last_lap]."</td>";
			echo "<td>".$item[laps]."</td>";
			echo "<td>".$item[team_id]."</td>";
			echo "<td>".$item[pilot_id]."</td>";
		}
	}
	?>
	</tr>
	</tbody>
	</table>
	</div>
	<div class="history_tables" id="box_hist_5">	
		<div class="history_tables_name">Карт 5</div>
		<table>
			<thead>
				<tr>
					<td>ЛК</td>
					<td>Последний круг</td>
					<td>Круг</td>
					<td>Номер команды</td>
					<td>Номер пилота</td>
				</tr>
			</thead>
			<tbody>
				<tr>
		<?php		
	//Ищем


	foreach($get_karts_array as  $key => $item) {
		if ($key == '5') {
			echo "<td>".$item[best_lap]."</td>";
			echo "<td>".$item[last_lap]."</td>";
			echo "<td>".$item[laps]."</td>";
			echo "<td>".$item[team_id]."</td>";
			echo "<td>".$item[pilot_id]."</td>";
		}
	}
	?>
	</tr>
	</tbody>
	</table>
	</div>
	<div class="history_tables" id="box_hist_6">	
		<div class="history_tables_name">Карт 6</div>
		<table>
			<thead>
				<tr>
					<td>ЛК</td>
					<td>Последний круг</td>
					<td>Круг</td>
					<td>Номер команды</td>
					<td>Номер пилота</td>
				</tr>
			</thead>
			<tbody>
				<tr>
		<?php		
	//Ищем


	foreach($get_karts_array as  $key => $item) {
		if ($key == '6') {
			echo "<td>".$item[best_lap]."</td>";
			echo "<td>".$item[last_lap]."</td>";
			echo "<td>".$item[laps]."</td>";
			echo "<td>".$item[team_id]."</td>";
			echo "<td>".$item[pilot_id]."</td>";
		}
	}
	?>
	</tr>
	</tbody>
	</table>
	</div>

	<div class="history_tables" id="box_hist_7">	
		<div class="history_tables_name">Карт 7</div>
		<table>
			<thead>
				<tr>
					<td>ЛК</td>
					<td>Последний круг</td>
					<td>Круг</td>
					<td>Номер команды</td>
					<td>Номер пилота</td>
				</tr>
			</thead>
			<tbody>
				<tr>
		<?php		
	//Ищем


	foreach($get_karts_array as  $key => $item) {
		if ($key == '7') {
			echo "<td>".$item[best_lap]."</td>";
			echo "<td>".$item[last_lap]."</td>";
			echo "<td>".$item[laps]."</td>";
			echo "<td>".$item[team_id]."</td>";
			echo "<td>".$item[pilot_id]."</td>";
		}
	}
	?>
	</tr>
	</tbody>
	</table>
	</div>
	<div class="history_tables" id="box_hist_8">	
		<div class="history_tables_name">Карт 8</div>
		<table>
			<thead>
				<tr>
					<td>ЛК</td>
					<td>Последний круг</td>
					<td>Круг</td>
					<td>Номер команды</td>
					<td>Номер пилота</td>
				</tr>
			</thead>
			<tbody>
				<tr>
		<?php		
	//Ищем


	foreach($get_karts_array as  $key => $item) {
		if ($key == '8') {
			echo "<td>".$item[best_lap]."</td>";
			echo "<td>".$item[last_lap]."</td>";
			echo "<td>".$item[laps]."</td>";
			echo "<td>".$item[team_id]."</td>";
			echo "<td>".$item[pilot_id]."</td>";
		}
	}
	?>
	</tr>
	</tbody>
	</table>
	</div>
	<div class="history_tables" id="box_hist_9">	
		<div class="history_tables_name">Карт 9</div>
		<table>
			<thead>
				<tr>
					<td>ЛК</td>
					<td>Последний круг</td>
					<td>Круг</td>
					<td>Номер команды</td>
					<td>Номер пилота</td>
				</tr>
			</thead>
			<tbody>
				<tr>
		<?php		
	//Ищем


	foreach($get_karts_array as  $key => $item) {
		if ($key == '9') {
			echo "<td>".$item[best_lap]."</td>";
			echo "<td>".$item[last_lap]."</td>";
			echo "<td>".$item[laps]."</td>";
			echo "<td>".$item[team_id]."</td>";
			echo "<td>".$item[pilot_id]."</td>";
		}
	}
	?>
	</tr>
	</tbody>
	</table>
	</div>

	<div class="history_tables" id="box_hist_10">	
		<div class="history_tables_name">Карт 10</div>
		<table>
			<thead>
				<tr>
					<td>ЛК</td>
					<td>Последний круг</td>
					<td>Круг</td>
					<td>Номер команды</td>
					<td>Номер пилота</td>
				</tr>
			</thead>
			<tbody>
				<tr>
		<?php		
	//Ищем


	foreach($get_karts_array as  $key => $item) {
		if ($key == '10') {
			echo "<td>".$item[best_lap]."</td>";
			echo "<td>".$item[last_lap]."</td>";
			echo "<td>".$item[laps]."</td>";
			echo "<td>".$item[team_id]."</td>";
			echo "<td>".$item[pilot_id]."</td>";
		}
	}
	?>
	</tr>
	</tbody>
	</table>
	</div>
	<div class="history_tables" id="box_hist_13">	
		<div class="history_tables_name">Карт 13</div>
		<table>
			<thead>
				<tr>
					<td>ЛК</td>
					<td>Последний круг</td>
					<td>Круг</td>
					<td>Номер команды</td>
					<td>Номер пилота</td>
				</tr>
			</thead>
			<tbody>
				<tr>
		<?php		
	//Ищем


	foreach($get_karts_array as  $key => $item) {
		if ($key == '13') {
			echo "<td>".$item[best_lap]."</td>";
			echo "<td>".$item[last_lap]."</td>";
			echo "<td>".$item[laps]."</td>";
			echo "<td>".$item[team_id]."</td>";
			echo "<td>".$item[pilot_id]."</td>";
		}
	}
	?>
	</tr>
	</tbody>
	</table>
	</div>
	<div class="history_tables" id="box_hist_21">	
		<div class="history_tables_name">Карт 21</div>
		<table>
			<thead>
				<tr>
					<td>ЛК</td>
					<td>Последний круг</td>
					<td>Круг</td>
					<td>Номер команды</td>
					<td>Номер пилота</td>
				</tr>
			</thead>
			<tbody>
				<tr>
		<?php		
	//Ищем


	foreach($get_karts_array as  $key => $item) {
		if ($key == '21') {
			echo "<td>".$item[best_lap]."</td>";
			echo "<td>".$item[last_lap]."</td>";
			echo "<td>".$item[laps]."</td>";
			echo "<td>".$item[team_id]."</td>";
			echo "<td>".$item[pilot_id]."</td>";
		}
	}
	?>
	</tr>
	</tbody>
	</table>
	</div>

	<div class="history_tables" id="box_hist_33">	
		<div class="history_tables_name">Карт 33</div>
		<table>
			<thead>
				<tr>
					<td>ЛК</td>
					<td>Последний круг</td>
					<td>Круг</td>
					<td>Номер команды</td>
					<td>Номер пилота</td>
				</tr>
			</thead>
			<tbody>
				<tr>
		<?php		
	//Ищем


	foreach($get_karts_array as  $key => $item) {
		if ($key == '33') {
			echo "<td>".$item[best_lap]."</td>";
			echo "<td>".$item[last_lap]."</td>";
			echo "<td>".$item[laps]."</td>";
			echo "<td>".$item[team_id]."</td>";
			echo "<td>".$item[pilot_id]."</td>";
		}
	}
	?>
	</tr>
	</tbody>
	</table>
	</div>
	<div class="history_tables" id="box_hist_69">	
		<div class="history_tables_name">Карт 69</div>
		<table>
			<thead>
				<tr>
					<td>ЛК</td>
					<td>Последний круг</td>
					<td>Круг</td>
					<td>Номер команды</td>
					<td>Номер пилота</td>
				</tr>
			</thead>
			<tbody>
				<tr>
		<?php		
	//Ищем


	foreach($get_karts_array as  $key => $item) {
		if ($key == '69') {
			echo "<td>".$item[best_lap]."</td>";
			echo "<td>".$item[last_lap]."</td>";
			echo "<td>".$item[laps]."</td>";
			echo "<td>".$item[team_id]."</td>";
			echo "<td>".$item[pilot_id]."</td>";
		}
	}
	?>
	</tr>
	</tbody>
	</table>
	</div>


	</div>

<?php require_once 'footer.php'; ?>