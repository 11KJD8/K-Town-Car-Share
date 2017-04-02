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
		var str = "SELECT * FROM reservation WHERE DAY(ReservationDate)="+date[1]+" AND MONTH(ReservationDate)="+date[0]+" AND YEAR(ReservationDate)="+date[2];
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
