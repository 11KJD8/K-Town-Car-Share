<?php
include 'Core/init.php';


$q = $_REQUEST["q"];
$query = "SELECT CivicAddress,Municipality,Province,PostalCode,Country FROM CarType NATURAL JOIN Cars NATURAL JOIN Location_Address WHERE CarType.CarType = '$q'";
$results = mysql_query($query);
$returnText = "";
while ($row=mysql_fetch_row($results)){
  $temp = "<li><a href='#'> $row[0] $row[1] $row[2] $row[3] $row[4] </a></li>";
  if (strpos($returnText, $temp) === false) {
      $returnText .= $temp;
  }
}
echo $returnText === "" ? "no locations" : $returnText;
?>
