<?php
include 'Core/init.php';
redirect_to_login();

$query = $_GET['query'];
mysql_query($query);
$returnText = mysql_error();
echo $returnText;
?>