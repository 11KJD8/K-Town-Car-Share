<?php
session_start();

require 'Database/connect.php';
require 'Functions/general.php';
require 'Functions/users.php';

if(logged_in() === true){
	$session_user_id = $_SESSION['MemberID'];
	$user_data = user_data($session_user_id, 'MemberID', 'Username', 'Password', 'MemberType', 'FName', 'LName', 'Email');
	if(user_active($user_data['Username']) === false){
		session_destroy();
		header('Location: index.php');
		exit();
	}
}

$errors = array();
?>