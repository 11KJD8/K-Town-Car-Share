<?php
include 'Core/init.php';
redirect_to_login();
include 'Includes/Overall/header.php';
?>

<div id='invoice'>
	<form action="gen_invoice.php" method="GET">
	<?php
		$allUsers = allUsers();
		for ($i = 0; $i < mysql_num_rows($allUsers);$i++){
			$data = mysql_fetch_assoc($allUsers,$i);
			echo "<input type='radio' name='id' value='".$data['MemberID']."'>".$data['Username']."<br>";
		}
	?>
	Month:
	<input type='number' name='month' min="1" max="12" required><br>
	Year:
	<?php echo"<input type='number' name='year' min='2016' max='".getdate()['year']."' required><br> "?>
	<input type='submit' value='Calculate Invoice'>
	</form>
	
</div>

<?php
include 'Includes/Overall/footer.php';
?>