<?php
include 'Core/init.php';
redirect_to_login();
include 'Includes/Overall/header.php';
?>
  <select>
    <?php
      $date = getdate();
      $month = $date['mon'];
      $date = $date['mdate'];
      $year = $date['year'];
      
    ?>
  </select>
  Please enter odometer reading: <input type="text" name="OdometerBefore" value=""><br>
  <button>Submit</button>
<?php
include 'Includes/Overall/footer.php';
?>
