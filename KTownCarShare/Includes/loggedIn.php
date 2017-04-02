<div id="userContent">
	<li><a href="userSelectCar.php">View Cars</a></li>
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
		</ul>
	</div>
</div>