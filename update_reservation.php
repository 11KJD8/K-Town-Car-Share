<?php
include 'Core/init.php';
redirect_to_login();
mysql_query($_GET['query']);
if(mysql_error()){
  header('Location: userProfile.php?error=failed%20to$20update%20car');
}else{
  if (isset($_GET['pickup'])){
    include 'Includes/Overall/header.php';
    $result = mysql_query("SELECT AccessCode FROM reservation WHERE VIN = ".$_GET['pickup']." AND ReservationDate = CURDATE()");
    $data = mysql_fetch_assoc($result);
    echo "<h1 style='text-align:center'>Access code is: ".$data['AccessCode']."</h1>";
  }else{
    header('Location: userProfile.php');
  }
}
?>

<?php
include 'Includes/Overall/footer.php';
?>
