<?php
function email($to, $subject, $body){
	mail($to, $subject, $body, 'From: kyle.delaney0@gmail.com');
}

function logged_in_redirect(){
	//If already logged in prevent registration
	if(logged_in() === true){
		header('Location: userProfile.php');
		exit();
	}
}

function redirect_to_login(){
	//Prevents user from accessing things that they shouldn't be able to if not logged in
	if(logged_in() === false){
		header('Location: login.php');
		exit();
	}
}

function array_sanitize(&$item){
	//This helps prevent SQL injection in register data
	$item = htmlentities(mysql_real_escape_string($item));
}

function sanitize($data){
	//This helps prevent SQL injection
	return htmlentities(mysql_real_escape_string($data));
}

function output_errors($errors){
	return '<ul id="error-list"><li>' . implode('</li><li>',$errors) . '</li><ul>';
}
?>
