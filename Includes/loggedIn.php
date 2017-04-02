<div id="userContent">
	<li><a href="userSelectCar.php">View Cars</a></li>
	<li><a href="findLocations.php">Find Locations</a></li>
	<li><a href='pickup.php'>Pick Up Car</a></li>
	<li><a href='dropoff.php'>Drop Off Car</a></li>
	<li><a href='member_history.php'>Rental History</a></li>
</div>
<div id="userWidget">
	<h2>Hello, <?php echo $user_data['FName']; ?>!</h2>
	<div>
		<ul>
			<li>
				<a href="changepassword.php">Change password</a>
			</li>
			<li>
				<a href="settings.php">Settings</a>
			</li>
		</ul>
	</div>
</div>
