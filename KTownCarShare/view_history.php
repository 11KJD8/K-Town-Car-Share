<?php
include 'Core/init.php';
redirect_to_login();
include 'Includes/Overall/header.php';
$vin = $_GET['vin'];
?>
<div>
	<ul>
	<?php
		$query = "SELECT * FROM (reservation JOIN members ON members.MemberID = reservation.MemberID) WHERE VIN=".$vin;
		$results = mysql_query($query);
		for($i = 0; $i < mysql_num_rows($results);$i++){
			$data = mysql_fetch_assoc($results);
			$returned = 'Returned';
			if (is_null($data['OdometerAfter'])){
				$returned = 'Not Returned'; #changes this later???? better word????
			}
			echo "<li>".$data['VIN']." ".$data['MemberID']." ".$data['FName']." ".$data['LName']." ".$data['ReservationDate']." ".$returned."</li>";
		}
	?>
	</ul>
</div>
<?php include 'Includes/Overall/footer.php'; ?>