<?php
	include 'Core/init.php';
	$query = $_GET['query'];
	$result = mysql_query($query);
	$returnText = "<ul>";
	echo mysql_error();
	for($i = 0; $i < mysql_num_rows($result);$i++){
		$data = mysql_fetch_assoc($result);
		$content = implode(" ",$data);
		$returnText.="<li>".$content."</li>";
	}
$returnText.="</ul>";	
	echo $returnText === "" ? "<p>no reservations found</p>" : $returnText;
?>