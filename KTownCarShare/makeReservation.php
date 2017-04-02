<?php
include 'Core/init.php';
redirect_to_login();
include 'Includes/Overall/header.php';
echo "<p id='memberID' hidden>".$_SESSION['MemberID']."</p>";
echo "<p id='vin' hidden>".$_GET['vin']."</p>";
?>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
$( function() {
$( "#datepicker").datepicker();
} );

function query() {
	var temp = document.getElementById("datepicker").value.split("/");
	var date = temp[2] + "-" + temp[0] + "-" + temp[1];
	var memID = document.getElementById("memberID").innerHTML;
	var vin = document.getElementById("vin").innerHTML;
	var str = "INSERT INTO reservation(MemberID,VIN,ReservationDate) VALUES ("+memID+","+vin+",'"+date+"')";
	console.log(str);
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			console.log(this.responseText);
		}
	};
	xmlhttp.open("GET", "ajax_reply_query.php?query=" + str, true);
	xmlhttp.send();
};
</script>
<div>
Date: <input type="text" id="datepicker">
<button onclick = "query()">Reserve</button>
</div>
<div id="reservation-list">
</div>
<?php include 'Includes/Overall/footer.php'; ?>