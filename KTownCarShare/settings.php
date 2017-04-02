<?php
include 'Core/init.php';
redirect_to_login();
include 'Includes/Overall/header.php';
if(empty($_POST) === false){
	//Gets all the required fields.
	$required_fields = array('FName', 'Email'); //More fields can be added
	foreach($_POST as $key=>$value){
		if(empty($value) && in_array($key, $required_fields) === true){
			$errors[] = 'Fields marked with an asterisk are required.';
			break 1;
		}
	}
	if(empty($errors) === true){
		if(filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL) === false){
			$errors[] = 'A valid email address is required.';
		}
		else if(email_exists($_POST['Email']) === true && $user_data['Email'] !== $_POST['Email']){
			$errors[] = 'Sorry, the email \'' . $_POST['Email'] . '\' is already in use.';
		}
	}
}
?>

<div id="settings">
	<h1>Settings</h1>

	<?php
	if(isset($_GET['success']) === true && empty($_GET['success']) === true){
		echo'Account information has been updated.';
	}else{
		if(empty($_POST) === false && empty($errors) === true){
			$update_data = array(
				'FName' 	=> $_POST['FName'],
				'LName' 	=> $_POST['LName'],
				'Email' 	=> $_POST['Email']
			);
			update_user($update_data);
			header('Location: settings.php?success');
			exit();
		}else if(empty($errors) === false){
			echo output_errors($errors);
		}
		?>
		<form action="" method="post">
			<ul>
				<li>
					First name*:<br>
					<input type="text" name="FName" value="<?php echo $user_data['FName'];?>">
				</li>
				<li>
					Last name:<br>
					<input type="text" name="LName" value="<?php echo $user_data['LName'];?>">
				</li>
				<li>
					Email*:<br>
					<input type="text" name="Email" value="<?php echo $user_data['Email'];?>">
				</li>
				<li>
					<input type="submit" value="Update">
				</li>
			</ul>
		</form>
	</div>
	<?php
	}
include 'Includes/Overall/footer.php';
?>