<?php
include 'Core/init.php';
redirect_to_login();
include 'Includes/Overall/header.php';
?>
<script>
  function update(){
    var odm = document.getElementById('odm-input').value;
    var vin = document.getElementById('vin-selector').value;
    var query = "UPDATE reservation SET OdometerBefore="+odm+" WHERE VIN="+vin+" AND ReservationDate = (SELECT CURDATE())";
    location.href = "update_reservation.php?pickup="+vin+"&query="+query;
  }
</script>
  <h4>Select car:</h4><select id='vin-selector' style="width:15em;">
    <option name='vin' value=''>-- choose car --</option>
    <?php
      $date = getdate();
      $month = $date['mon'];
      $day = $date['mday'];
      $year = $date['year'];
      $query = "SELECT cars.VIN, cars.Make, cars.Model, cars.ModelYear FROM (cars JOIN reservation ON cars.VIN = reservation.VIN) WHERE ReservationDate = '".$year."-".$month."-".$day."' AND reservation.OdometerBefore IS NULL";
      $results = mysql_query($query);
      echo mysql_num_rows($results);
      for ($i=0;$i<mysql_num_rows($results);$i++){
        $row = mysql_fetch_assoc($results);
        echo "<option name='vin' value='".$row['VIN']."'>".$row['VIN'].", ".$row['Make'].", ".$row['Model']." ".$row['ModelYear']."</option>";
      }
    ?>
  </select><br>
  <h4>Please enter odometer reading:</h4> <input id='odm-input' type="text" name="OdometerBefore" value=""><br>
  <button onclick=update()>Submit</button>
<?php
include 'Includes/Overall/footer.php';
?>
