<?php
include 'Core/init.php';
redirect_to_login();
include 'Includes/Overall/header.php';
?>
 <!--/* if(isset($_SESSION['Username']) === true && empty($_SESSION['Username']) === false){
	$Username = $_GET['Username'];
	if(user_exists($Username) === true){
		$MemberID = user_id_from_username($Username);
		$profile_data = user_data($MemberID, 'FName', 'LName', 'Email');
	}else{
		echo 'Sorry that user doesn\'t exist';
	}
}else{
	#header('Location: login.php');
	echo 'Error'
	exit();
}-->

<?php
if(isset($_SESSION['MemberID'])){
	if($user_data['MemberType'] === 'Admin'){
		include 'Includes/adminLoggedIn.php';
	}else{
		include 'Includes/loggedIn.php';
	}
}else{
	echo 'Not logged in';
}
?>

<?php
include 'Includes/Overall/footer.php';
?>
