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
	} );

	function query() {
		var date = document.getElementById("datepicker").value.split("/");
    var formated_date = date[2]+"-"+date[0]+"-"+date[1];
		var str = "SELECT * FROM reservation WHERE ReservationDate <= '"+formated_date+"' AND DATE_ADD(ReservationDate,INTERVAL Length DAY) > '"+formated_date+"'";
    console.log(str);
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("reservation-list").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET", "ajax_res_query.php?query=" + str, true);
		xmlhttp.send();
	};
  </script>
  <div>
	Date: <input type="text" id="datepicker" onchange = "query()">
  </div>
  <div id="reservation-list">
  </div>
<?php include 'Includes/Overall/footer.php'; ?>
