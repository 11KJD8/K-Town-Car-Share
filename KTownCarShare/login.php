<?php
include 'Core/init.php';
logged_in_redirect();
include 'Includes/Overall/header.php';
if(empty($_POST) === false){
	//We are checking the username and password for validity
	$Username = $_POST['Username'];
	$Password = $_POST['Password'];
	if(empty($Username) === true || empty($Password) === true){
		$errors[] = 'You need to enter a username and password.';
	}else if(user_exists($Username) === false){
		$errors[] = 'We cannot find that username.';
	}else if(user_active($Username) === false){
		$errors[] = 'User has not activied account.';
	}else{ //The username exists and is an active account
		if(strlen($Password) > 32){
			$errors[] = 'Password is too long.';
		}
		$login = login($Username,$Password);
		if($login === false){
			$errors[] = 'That username/password combination is incorrect.';
		}else{ //The username and password are correct so proceeds to log in
			$_SESSION['MemberID'] = $login;
			header('Location: userProfile.php');
			exit();
		}
	}
}else{
	//$errors[] = 'No data recieved';
}
?>

<div id="login">
	<h2>Login</h2>
	<?php
	if(empty($errors) === false){
	?>
		<h2>We tried to log you in, but...</h2>
	<?php
		echo output_errors($errors);
	}
	?>
	<div>
		<form action="login.php" method="post">
			<ul>
				<li>
					<input type="text" placeholder="Username" name="Username">
				</li>
				<li>
					<input type="password" placeholder="Password" name="Password">
				</li>
				<li>
					<input type="submit" value="Login">
				</li>
				<li>
					<a href="register.php">Register</a>
				</li>

			</ul>
		</form>
	</div>
</div>

<?php include 'Includes/Overall/footer.php'; ?>