<?php
include 'Core/init.php';
redirect_to_login();
include 'Includes/Overall/header.php';
?>
<script>
  function update(){
    var odm = document.getElementById('odm-input').value;
    var vin = document.getElementById('vin-selector').value;
    var status = document.getElementById('status-input').value;
    var rating = document.getElementById('rating-input').value;
    var comment = document.getElementById('comment-input').value;
    var query = "UPDATE reservation SET OdometerAfter="+odm+",ReturnStatus='"+status+"',CustRating="+rating+",CustComment='"+comment+"' WHERE VIN="+vin+" AND ReservationDate = (SELECT CURDATE())";
    location.href = "update_reservation.php?query="+query;
  }
</script>
  <h4>Select car:</h4> <select id='vin-selector' style="width:15em;">
    <option name='vin' value=''>-- choose car --</option>
    <?php
      $query = "SELECT cars.VIN, cars.Make, cars.Model, cars.ModelYear FROM (cars JOIN reservation ON cars.VIN = reservation.VIN) WHERE reservation.OdometerBefore IS NOT NULL AND reservation.OdometerAfter IS NULL";
      $results = mysql_query($query);
      echo mysql_num_rows($results);
      for ($i=0;$i<mysql_num_rows($results);$i++){
        $row = mysql_fetch_assoc($results);
        echo "<option name='vin' value='".$row['VIN']."'>".$row['VIN'].", ".$row['Make'].", ".$row['Model']." ".$row['ModelYear']."</option>";
      }
    ?>
  </select><br>

  <h4>Please enter the condition of the car:</h4> <input id='status-input' type='text' name='ReturnStatus' value=""><br>
  <h4>Please enter odometer reading:</h4> <input id='odm-input' type="text" name="OdometerAfter" value=""><br>
  <h4>Rating:</h4>
  <select id='rating-input'>
    <option name='rating' value='1'>1</option>
    <option name='rating' value='2'>2</option>
    <option name='rating' value='3'>3</option>
    <option name='rating' value='4'>4</option>
  </select><br>
  <h4>Comments:</h4>
  <textarea id='comment-input' rows='10' cols='80' style="border:1pt solid grey"></textarea><br>
  <button onclick=update()>Submit</button>
<?php
include 'Includes/Overall/footer.php';
?>
