<?php
include 'Core/init.php';
redirect_to_login();
include 'Includes/Overall/header.php';
$vin = $_GET['vin'];
$month = getdate()['mon'];
$year = getdate()['year'];
$day = getdate()['mday'];
?>
<div>
	<ul>
	<?php
		$query = "SELECT * FROM (reservation JOIN members ON members.MemberID = reservation.MemberID) WHERE VIN=".$vin." AND YEAR(ReservationDate) >=".$year." AND MONTH(ReservationDate) >=".$month." AND DAY(ReservationDate) >=".$day;
		$results = mysql_query($query);
		echo mysql_error();
		for($i = 0; $i < mysql_num_rows($results);$i++){
			$data = mysql_fetch_assoc($results);
			echo "<li>".$data['VIN']." ".$data['MemberID']." ".$data['FName']." ".$data['LName']." ".$data['ReservationDate']."</li>";
		}
	?>
	</ul>
</div>
<?php include 'Includes/Overall/footer.php'; ?>