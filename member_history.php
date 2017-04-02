<?php
include 'Core/init.php';
redirect_to_login();
include 'Includes/Overall/header.php';
$currentDate = getdate();
$reservationHistory = getUserReservationHistory($user_data['MemberID'],$currentDate);
?>

<table id="table">
	<?php
		echo "<tr>";
		for($i = 0; $i < mysql_num_fields($reservationHistory);$i++){
			$meta = mysql_fetch_field($reservationHistory,$i);
			echo "<th>".($meta->name)."</th>";
		}
		echo "</tr>";
		for($i = 0; $i < mysql_num_rows($reservationHistory);$i++){
			$data = mysql_fetch_assoc($reservationHistory);
			$content = implode("</td><td>",$data);
			echo "<tr><td>".$content."</td></tr>";
		}
	?>
</table>


<?php
include 'Includes/Overall/footer.php';
?>
