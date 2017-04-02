<?php
include 'Core/init.php';
redirect_to_login();
include 'Includes/Overall/header.php';
$query = "SELECT location_address.CivicAddress,location_address.Municipality,location_address.Province,location_address.PostalCode,location_address.Country From location_address";
$results = mysql_query($query);
?>
<table style='margin:auto;' cellspacing='10'>
  <tr>
    <?php
      for($i = 0; $i<mysql_num_fields($results);$i++){
        echo "<th>".mysql_field_name($results,$i)."</th>";
      }
    ?>
  </tr>
  <?php
    for($i = 0; $i<mysql_num_rows($results);$i++){
      $row = mysql_fetch_assoc($results);
      $content = implode("</td><td>",$row);
      echo "<tr><td>".$content."</td></tr>";
    }
  ?>

</table>
<?php
include 'Includes/Overall/footer.php';
?>
