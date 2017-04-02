<?php
include 'Core/init.php';
logged_in_redirect();
include 'Includes/Overall/header.php';

if(isset($_GET['success']) === true && empty($_GET['success']) === true){
?>
	<h2>Thanks. We've activated your account.</h2>
	<p>You're free to log in.</p>
<?php	
}else if(isset($_GET['Email'], $_GET['EmailCode']) === true){
	$Email = trim($_GET['Email']);
	$EmailCode = trim($_GET['EmailCode']);
	
	if(email_exists($Email) === false){
		$errors[] = 'Sorry, something went wrong, and we could not find that email address.';
	}else if(activate($Email, $EmailCode) === false){
		$errors[] = 'Sorry, we had problems activating your account.';
	}
	
	if(empty($errors) === false){
	?>
		<h2>Oops...</h2>
	<?php
		echo output_errors($errors);
	}else{
		header('Location: activate.php?success');
		exit();
	}
	
}else{
	echo 'test';
	//header('Location: index.php');
	exit();
}

include 'Includes/Overall/footer.php';
?>