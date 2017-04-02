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
		var str = "SELECT cars.* FROM (cars JOIN reservation ON cars.VIN = reservation.VIN) WHERE 1";
		var type = document.getElementById('type-filter').value;
		var location = document.getElementById('location-filter').value;
		var date = document.getElementById('datepicker').value;
		if (type !== ''){
			str += " AND CarType = " + type;
		}
		if (location !== ''){
			str += " AND LocationID = " + location;
		}
		if (date !== ''){
			var components = date.split("/");
			str += " AND ReservationDate  '"+components[2]+"-"+components[0]+"-"+components[1]+"'";
		}
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("carlist").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET", "ajax_query.php?admin=False&query=" + str, true);
		xmlhttp.send();
	}
	function view_reservations(vin){
		var d = new Date();
		var str = "SELECT members.MemberID, FName as `First Name`, LName as `Last Name`, ReservationDate FROM (reservation JOIN members ON reservation.MemberID = members.MemberID) WHERE VIN = "+vin+" AND ReservationDate > '"+d.getFullYear()+"-"+d.getMonth()+"-"+d.getDate()+"'";
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var id = vin+"-reservations";
				console.log(id);
				document.getElementById(id).innerHTML = this.responseText;
				console.log(document.getElementById(id).children[0]);
				var li = document.createElement("li");
				li.innerHTML = "<a href='' onclick='hide_reservations(\""+vin+"\");return false'>hide reservations</a>";
				document.getElementById(id).children[0].appendChild(li);
				document.getElementById(id).style = "list-style-type:none;";
				document.getElementById(id).children[0].style = "margin-left:2em;";
			}
		};
		xmlhttp.open("GET", "ajax_res_query.php?query=" + str, true);
		xmlhttp.send();
	}
	function hide_reservations(vin){
		var id = vin+"-reservations";
		document.getElementById(id).innerHTML = "<a href='' onclick='view_reservations(\""+vin+"\");return false;'>view reservations</a>";
		document.getElementById(id).style = "list-style-type:block;";
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
			Date: <input type="text" id="datepicker" onchange = "console.log(this.value)" placeholder="select date" value = ''>
		</li>
		<li>
			<button onclick="query()">Search</button>
		</li>
	</ul>

</div>
<div style='clear:both'></div>

<?php include 'Includes/Overall/footer.php'; ?>
