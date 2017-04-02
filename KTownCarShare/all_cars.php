<?php
include 'Core/init.php';
redirect_to_login();
include 'Includes/Overall/header.php';
?>
<script>
	function query(str) {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("carlist").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET", "ajax_query.php?admin=True&query=" + str, true);
		xmlhttp.send();
	}
</script>

<div id="carlist">
	<?php
		$query = "SELECT * FROM cars";
		$results = mysql_query($query);
		for($i = 0; $i < mysql_num_rows($results);$i++){
			$data = mysql_fetch_assoc($results);
			echo "<div class='index2'><div class='left-pic'><img src='https://img.1milioncars.com/e1ab7ee00f023b17faa045ce3e2d8744_download-3d-car-bentley-car-images-free-download_256-256.jpeg'></img></div><div class='right-text'><ul><li>vin: ".$data['VIN']."</li><li>make: ".$data['Make']."</li><li>model: ".$data['Model']."</li><li>model year: ".$data['ModelYear']."</li><li><a href='view_history.php?vin=".$data['VIN']."'>view history</a></li><li><a href='view_reservations.php?vin=".$data['VIN']."'>view reservations</a></li></ul></div><div style='clear:both;'></div></div>";
		}
	?>
</div>
<div id="filter-options">
	<h4>Filter Cars:</h4>
	<input type='radio' onclick="query('SELECT * FROM cars')" name='filter-option' checked> None <br>
	<input type='radio' onclick="query('SELECT cars.VIN, cars.Make, cars.Model, cars.ModelYear, odobyvin.ODOMETER_LatestReservation, odobyvin.ODOMETER_LatestMaintenance, odobyvin.Overage_Over5000 FROM cars JOIN ( SELECT res_odo.VIN,  res_odo.OdometerAfter As ODOMETER_LatestReservation, maint_odo.Odometer As ODOMETER_LatestMaintenance, (res_odo.OdometerAfter-maint_odo.Odometer) AS Overage_Over5000 FROM (SELECT reservation.VIN, reservation.ReservationDate, reservation.OdometerAfter FROM reservation JOIN (SELECT reservation.VIN, max(reservation.ReservationDate) As latestresdate FROM reservation GROUP BY reservation.VIN) AS latestres ON reservation.VIN = latestres.VIN AND reservation.ReservationDate = latestres.latestresdate) AS res_odo  JOIN (SELECT maintenance.VIN, maintenance.MaintenanceDate, maintenance.Odometer FROM maintenance JOIN (SELECT maintenance.VIN, max(maintenance.MaintenanceDate) As latestmaintdate FROM maintenance GROUP BY maintenance.VIN) AS latestmaint ON maintenance.VIN = latestmaint.VIN AND maintenance.MaintenanceDate = latestmaint.latestmaintdate) AS maint_odo ON res_odo.VIN = maint_odo.VIN WHERE (res_odo.OdometerAfter-maint_odo.Odometer) >= 5000) AS odobyvin on cars.VIN = odobyvin.VIN')" name='filter-option'> 5000km or more since last maintenance <br>
	<input type='radio' onclick="query('SELECT cars.*,t.num_rents FROM (cars LEFT JOIN((SELECT *,COUNT(VIN) as num_rents FROM reservation GROUP BY VIN) as t) ON cars.VIN = t.VIN) ORDER BY  t.num_rents DESC')" name='filter-option'> Highest number of rentals <br>
	<input type='radio' onclick="query('SELECT cars.*,t.num_rents FROM (cars LEFT JOIN((SELECT *,COUNT(VIN) as num_rents FROM reservation GROUP BY VIN) as t) ON cars.VIN = t.VIN) ORDER BY  t.num_rents')" name='filter-option'> Lowest number of rentals <br>
	<input type='radio' onclick="query('SELECT cars.VIN, cars.Make, cars.Model, cars.ModelYear, damagebyvin.ReturnStatus FROM cars JOIN ( SELECT reservation.VIN, reservation.ReturnStatus FROM reservation JOIN (SELECT reservation.VIN, max(reservation.ReservationDate) AS latestres_date FROM reservation GROUP BY reservation.VIN) AS latestres ON reservation.VIN = latestres.VIN AND reservation.ReservationDate = latestres.latestres_date WHERE reservation.ReturnStatus = \'Damaged\' AND latestres.latestres_date > (SELECT max(maintenance.MaintenanceDate) FROM maintenance GROUP BY maintenance.VIN HAVING maintenance.VIN = reservation.VIN) ) AS damagebyvin on cars.VIN = damagebyvin.VIN')" name='filter-option'> Damaged/need repairs <br>
	<input type='radio' onclick="query('SELECT cars.VIN, cars.Make, cars.Model, cars.ModelYear, damagebyvin.ReturnStatus FROM cars JOIN ( SELECT reservation.VIN, reservation.ReturnStatus FROM reservation JOIN (SELECT reservation.VIN, max(reservation.ReservationDate) AS latestres_date FROM reservation GROUP BY reservation.VIN) AS latestres ON reservation.VIN = latestres.VIN AND reservation.ReservationDate = latestres.latestres_date WHERE reservation.ReturnStatus = \'Damaged\' AND latestres.latestres_date > (SELECT max(maintenance.MaintenanceDate) FROM maintenance GROUP BY maintenance.VIN HAVING maintenance.VIN = reservation.VIN) ) AS damagebyvin on cars.VIN = damagebyvin.VIN')" name='filter-option'> Location 1 <br>
	
</div>
<div style='clear:both'></div>

<?php include 'Includes/Overall/footer.php'; ?>