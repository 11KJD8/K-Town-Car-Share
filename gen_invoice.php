<?php
include 'Core/init.php';
redirect_to_login();
include 'Includes/Overall/header.php';
$month = $_GET['month'];
$year = $_GET['year'];
$memID = $_GET['id'];
$total = 0;
$query = "SELECT `reservation`.`ReservationDate`,`cartype`.`cartype`,`cars`.`make`,`cars`.`model`,`cars`.`modelyear`,ROUND(`cartype`.BaseFee*(1-`membertype`.DiscountFactor),2) AS RentalPrice FROM (((`reservation` LEFT JOIN `cars` ON `reservation`.VIN = `cars`.VIN) LEFT JOIN `cartype` ON `cars`.CarType = `cartype`.CarType) LEFT JOIN `members` ON `reservation`.MemberID = `members`.MemberID) LEFT JOIN `membertype` ON `membertype`.MemberType = `members`.MemberType WHERE `members`.`MemberID` = ".$memID." AND month(`reservation`.`ReservationDate`) = ".$month." AND year(`reservation`.`ReservationDate`) = ".$year;
$results = mysql_query($query);
?>
 <table style="width:100%;clear:both;">
  <tr>
    <th>DATE</th>
    <th>CAR TYPE</th>
    <th>MAKE</th>
    <th>MODEL</th>
    <th>MODEL YEAR</th>
    <th>PRICE</th>
  </tr>
  
<?php
for ($i = 0; $i < mysql_num_rows($results);$i++){
	echo "<tr>";
	$row = mysql_fetch_assoc($results);
	foreach($row as $data){
		echo "<td>".$data."</td>";
	}
	$total+=$row['RentalPrice'];
	echo "</tr>";
}
?>
</table>
<table style="width:20%;float:right;align:right;">
	<tr>
		<th>TOTAL</th>
	</tr>
	<?php
		echo "<tr><td>".$total."</td></tr>";
	?>
</table>
<?php
include 'Includes/Overall/footer.php';
?>