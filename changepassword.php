<?php
include 'Core/init.php';
redirect_to_login();
include 'Includes/Overall/header.php';
if(empty($_POST) === false){
	$required_fields = array('current_password', 'Password', 'retype_password');
	foreach($_POST as $key=>$value){
		if(empty($value) && in_array($key, $required_fields) === true){
			$errors[] = 'Fields marked with an asterisk are required.';
			break 1;
		}
	}
	if(md5($_POST['current_password']) === $user_data['Password']){
		if(trim($_POST['Password']) !== trim($_POST['retype_password'])){
			$errors[] = 'New passwords do not match.';
		}else if(strlen($_POST['Password']) < 6 && strlen($_POST['Password']) > 32){
			$errors[] = 'Sorry, your password must be at least 6 characters and no more than 32.';
		}
	}else{
		$errors[] = 'Your current password is incorrect.';
	}
}
?>

<div id="changePass">
	<h1>Change Password</h1>
	<?php
	if(isset($_GET['success']) && empty($_GET['success'])){
		echo 'Your password has been changed.';
	}else{
		if(empty($_POST) === false && empty($errors) === true){
			change_password($session_user_id, $_POST['Password']);
			header('Location: changepassword.php?success');
		}else if(empty($errors) === false){
			echo output_errors($errors);
		}
		?>
			
		<form action="" method="post">
			<ul>
				<li>
					<input type="password" placeholder="Current Password*" name="current_password">
				</li>
				<li>
					<input type="password" placeholder="New Password*" name="Password">
				</li>
				<li>
					<input type="password" placeholder="Retype Password*" name="retype_password">
				</li>
				<li>
					<input type="submit" value="Change password">
				</li>
			</ul>
		</form>
	</div>
	<?php 
	}
include 'Includes/Overall/footer.php'; ?>