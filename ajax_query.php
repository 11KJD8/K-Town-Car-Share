<?php
	include 'Core/init.php';
	$query = $_GET['query'];
	$result = mysql_query($query);
	$returnText = "";
	$admin = $_GET['admin'];
	#echo mysql_error();
	for($i = 0; $i < mysql_num_rows($result);$i++){
		$data = mysql_fetch_assoc($result);
		if ($admin == 'True'){
			$returnText.="<div class='index2'><div class='left-pic'><img src='https://img.1milioncars.com/e1ab7ee00f023b17faa045ce3e2d8744_download-3d-car-bentley-car-images-free-download_256-256.jpeg'></img></div><div class='right-text'><ul><li>vin: ".$data['VIN']."</li><li>make: ".$data['Make']."</li><li>model: ".$data['Model']."</li><li>model year: ".$data['ModelYear']."</li><li><a href='view_history.php?vin=".$data['VIN']."'>view history</a></li><li id='".$data['VIN']."-reservations'><a href='' onclick='view_reservations(\"".$data['VIN']."\");return false;'>view reservations</a></li></ul></div><div style='clear:both;'></div></div>";
		}else {
			$returnText.="<div class='index2'><div class='left-pic'><img src='https://img.1milioncars.com/e1ab7ee00f023b17faa045ce3e2d8744_download-3d-car-bentley-car-images-free-download_256-256.jpeg'></img></div><div class='right-text'><ul><li>vin: ".$data['VIN']."</li><li>make: ".$data['Make']."</li><li>model: ".$data['Model']."</li><li>model year: ".$data['ModelYear']."</li><li><a href='makeReservation.php?vin=".$data['VIN']."'>Make reservation</a></li></ul></div><div style='clear:both;'></div></div>";
		}
	}	
	echo $returnText === "" ? "<p>no cars found</p>" : $returnText;
?>
