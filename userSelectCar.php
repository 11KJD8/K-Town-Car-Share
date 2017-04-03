<?php
include 'Core/init.php';
redirect_to_login();
include 'Includes/Overall/header.php';
?>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
	$( function() {
		$( "#datepicker").datepicker();
	});

	function query() {
		var str = "SELECT cars.*,location_address.CivicAddress FROM ((cars LEFT JOIN reservation ON cars.VIN = reservation.VIN) JOIN location_address ON cars.LocationID = location_address.LocationID) WHERE 1";
		var type = document.getElementById('type-filter').value;
		var location = document.getElementById('location-filter').value;
		var date = document.getElementById('datepicker').value;
		var length = document.getElementById('length-input').value;
		if (type !== ''){
			str += " AND cars.CarType = '" + type +"'";
		}
		if (location !== ''){
			str += " AND cars.LocationID = " + location;
		}
		var components = date.split("/");
		var formated_date = components[2]+"-"+components[0]+"-"+components[1];
		str += " AND cars.VIN NOT IN (SELECT VIN FROM reservation WHERE ReservationDate <= '"+formated_date+"' AND '"+formated_date+"' < (SELECT DATE_ADD(ReservationDate,INTERVAL Length DAY))) GROUP BY cars.VIN";
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("carlist").innerHTML = this.responseText;
				var links = document.getElementsByClassName("res-link")
				for (i = 0; i< links.length;i++){
					links[i].href += "&date="+components[2]+"-"+components[0]+"-"+components[1];
				}
			}
		};
		xmlhttp.open("GET", "ajax_query.php?admin=False&query=" + str+"&length="+length, true);
		xmlhttp.send();
		document.getElementById('errmessage').style.display='none';
	}
</script>

<div id="carlist">

</div>
<div id="filter-options">
	<h4>Car Filters:</h4><br>
	<ul style="list-style-type:none;padding-left:2em;">
		<li>
			CarType:
			<select id='type-filter'>
				<option value=''>Select a car type</option>
				<?php
					$query = "SELECT CarType FROM cartype";
					$results = mysql_query($query);
					for ($i = 0; $i < mysql_num_rows($results);$i++){
						$row = mysql_fetch_assoc($results);
						echo "<option value='".$row['CarType']."'>".$row['CarType']."</option>";
					}
				?>
			</select>
		</li>
		<li>
			Location:
			<select id="location-filter">
				<option value=''>Select a location</option>
				<?php
					$query = "SELECT LocationID,CivicAddress FROM location_address";
					$results = mysql_query($query);
					for ($i = 0; $i < mysql_num_rows($results);$i++){
						$row = mysql_fetch_assoc($results);
						echo "<option value='".$row['LocationID']."'>".$row['CivicAddress']."</option>";
					}
				?>
			</select>
		</li>
		<li>
			Length: <input id='length-input' type="number" min="1" value=1>
		</li>
		<li>
			<p id='errmessage' style="color:red;display:none;">Please select a date</p>
			Date: <input type="text" id="datepicker" placeholder="select date" value = ''>
		</li>
		<li>
			<button onclick="if(document.getElementById('datepicker').value!==''){query();}else{document.getElementById('errmessage').style.display='block';};">Search</button>
		</li>
	</ul>

</div>
<div style='clear:both'></div>

<?php include 'Includes/Overall/footer.php'; ?>
