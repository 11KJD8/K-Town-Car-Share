<div id="userContent">
	<li><a href="invoice.php">Monthly invoice</a></li>
	<li><a href="addCar.php">Add car</a></li>
	<li><a href="all_cars.php">View Cars</a></li>
	<li><a href="all_reservations.php">Show reservations</a></li>
	<li><a href="comments.php">Respond To Comments</a></li>
</div>
<div id="userWidget">
	<h2>Hello, <?php echo $user_data['FName']; ?>!</h2>
	<div>
		<ul>
			<li>
				<a href="logout.php">Logout</a>
			</li>
			<li>
				<a href="userProfile.php?Username=<?php echo $user_data['Username'];?>">Profile</a>
			</li>
			<li>
				<a href="changepassword.php">Change password</a>
			</li>
			<li>
				<a href="settings.php">Settings</a>
			</li>
			<li>
				<?php
					include 'Includes/Widgets/user_count.php';
				?>
			</li>
		</ul>
	</div>
</div>