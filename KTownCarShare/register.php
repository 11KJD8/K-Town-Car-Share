<?php
include 'Core/init.php';
logged_in_redirect();
include 'Includes/Overall/header.php';
if(empty($_POST) === false){
	//Gets all the required fields.
	$required_fields = array('Username', 'Password', 'retype_password', 'FName', 'Email'); //More fields can be added
	foreach($_POST as $key=>$value){
		if(empty($value) && in_array($key, $required_fields) === true){
			$errors[] = 'Fields marked with an asterisk are required.';
			break 1;
		}
	}
	if(empty($errors) === true){
		//Validation for all the important fields
		if(user_exists($_POST['Username']) === true){
			$errors[] = 'Sorry, the username \'' . $_POST['Username'] . '\' already exists.';
		}
		if(preg_match("/\\s/", $_POST['Username']) == true){
			$errors[] = 'Your username must not contain any spaces.';
		}
		if(strlen($_POST['Password']) < 6 && strlen($_POST['Password']) > 32){
			$errors[] = 'Sorry, your password must be at least 6 characters and no more than 32.';
		}
		if($_POST['Password'] !== $_POST['retype_password']){
			$errors[] = 'Passwords do not match.';
		}
		if(filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL) === false){
			$errors[] = 'A valid email address is required.';
		}
		if(email_exists($_POST['Email']) === true){
			$errors[] = 'Sorry, the email \'' . $_POST['Email'] . '\' is already in use.';
		}
	}
}
?>

<div id="register">
	<h1>Register</h1>
	<?php
	if(isset($_GET['success']) === true && empty($_GET['success']) === false){
		echo'You have been registered successfully! Check your email to activate your account.';
	}else{
		if(empty($_POST) === false && empty($errors) === true){
			$register_data = array(
				'Username' 	=> $_POST['Username'],
				'Password' 	=> $_POST['Password'],
				'FName' 	=> $_POST['FName'],
				'LName' 	=> $_POST['LName'],
				'Email' 	=> $_POST['Email'],
				'EmailCode' => md5($_POST['Username'] + microtime())
			);
			register_user($register_data);
			header('Location: register.php?success');
			exit();
		}else if(empty($errors) === false){
			echo output_errors($errors);
		}
		?>
		<form action="" method="post">
			<ul>
				<li>
					<input type="text" placeholder="Username*" name="Username">
				</li>
				<li>
					<input type="password" placeholder="Password*" name="Password">
				</li>
				<li>
					<input type="password" placeholder="Retype Password*" ="retype_password">
				</li>
				<li>
					<input type="text" placeholder="First Name*" name="FName">
				</li>
				<li>
					<input type="text" placeholder="Last Name:" name="LName">
				</li>
				<li>
					<input type="text" placeholder="Email*" name="Email">
				</li>
				<li>
					<input type="submit" placeholder="Retype Password*" value="Register">
				</li>
			</ul>
		</form>
	</div>
	<?php
	}
include 'Includes/Overall/footer.php';
?>