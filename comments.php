<?php
include 'Core/init.php';
redirect_to_login();
include 'Includes/Overall/header.php';
$query = "SELECT reservation.MemberID, members.Fname, members.LName, reservation.ReservationDate, cars.VIN, cars.Make, cars.Model, cars.ModelYear, reservation.CustRating, reservation.CustComment, reservation.AdminComment FROM ((reservation JOIN cars ON reservation.VIN = cars.VIN) JOIN members ON members.MemberID = reservation.MemberID)";
$result = mysql_query($query);
for($i =0; $i<mysql_num_rows($result);$i++){
	$data = mysql_fetch_assoc($result);
	echo "<div class='reservation'><ul><li>Member ID: ".$data['MemberID']."</li><li>Name: ".$data['Fname']." ".$data['LName']."</li><li>Reservation Date: ".$data['ReservationDate']."</li><li>VIN: ".$data['VIN']."</li><li>Make: ".$data['Make']."</li><li>Model: ".$data['Model']."</li><li>Model Year: ".$data['ModelYear']."</li><li>User comment: ".$data['CustComment']."</li><li>Admin Reply: ".$data['AdminComment']."</li><li><a href='reply.php?memID=".$data['MemberID']."&vin=".$data['VIN']."&date=".$data['ReservationDate']."'>Reply To Comment</a></ul></div><br>";
}
?>


  
<?php include 'Includes/Overall/footer.php'; ?>