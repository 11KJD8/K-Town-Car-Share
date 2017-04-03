<?php
function update_user($update_data){
	$update = array();
	array_walk($update_data, 'array_sanitize');

	foreach($update_data as $field=>$data){
		$update[] = '`' . $field . '` = \'' . $data . '\'';
	}
	mysql_query("UPDATE `members` SET " . implode(', ', $update) . " WHERE `MemberID` = " . $_SESSION['MemberID']);
}

function activate($Email, $EmailCode){
	$Email = mysql_real_escape_string($Email);
	$EmailCode = mysql_real_escape_string($EmailCode);
	if(mysql_result(mysql_query("SELECT COUNT(`MemberID`) FROM `members` WHERE `Email` = '$Email' AND `EmailCode` = '$EmailCode' AND `Active` = 0"), 0) == 1){
		mysql_query("UPDATE `members` SET `Active` = 1 WHERE `Email` = '$Email'");
		return true;
	}else{
		return false;
	}
}

function change_password($MemberID, $Password){
	$MemberID = (int)$MemberID;
	$Password = md5($Password);
	mysql_query("UPDATE `members` SET `Password` = '$Password' WHERE `MemberID` = $MemberID");
}

function register_user($register_data){
	array_walk($register_data, 'array_sanitize');
	$register_data['Password'] = md5($register_data['Password']);
	$fields = '`' . implode('`, `', array_keys($register_data)) . '`';
	$data = '\'' . implode('\', \'', $register_data) . '\'';
	mysql_query("INSERT INTO `members` ($fields) VALUES ($data)");
	email($register_data['Email'], 'Activate your account', "Hello " . $register_data['FName'] . ",\n\nYou need to activate your account, so use this link below:\n\nhttp://localhost:8080/KTownCarShare/activate.php?Email=" . $register_data['Email'] . "&EmailCode=" . $register_data['EmailCode'] . "\n\n Regards,\nK-Town Car Share");
}

function user_count(){
	//Counts total number of active accounts
	return mysql_result(mysql_query("SELECT COUNT(`MemberID`) FROM `members` WHERE `Active` = 1"), 0);
}

function user_data($MemberID){
	//Use this to load in any user data from the members table
	$data = array();
	$MemberID = (int)$MemberID;

	$func_num_args = func_num_args();
	$func_get_args = func_get_args();

	if($func_num_args > 1){
		unset($func_get_args[0]);
		$fields = '`' . implode('`, `', $func_get_args) . '`';
		$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `members` WHERE `MemberID` = $MemberID"));
		return $data;
	}
}

function logged_in(){
	//Checks if logged in
	return(isset($_SESSION['MemberID'])) ? true : false;
}

function user_exists($Username){
	//This checks if an email is already in use by an account
	$Username = sanitize($Username);
	$query = mysql_query("SELECT COUNT(`MemberID`) FROM `members` WHERE `Username` = '$Username'");
	return (mysql_result($query,0) == 1) ? true : false;
}

function email_exists($Email){
	//This checks if a user account exists
	$Email = sanitize($Email);
	$query = mysql_query("SELECT COUNT(`MemberID`) FROM `members` WHERE `Email` = '$Email'");
	return (mysql_result($query,0) == 1) ? true : false;
}

function user_active($Username){
	//This checks if a user account exists
	$Username = sanitize($Username);
	$query = mysql_query("SELECT COUNT(`MemberID`) FROM `members` WHERE `Username` = '$Username' AND `Active` = '1'");
	return (mysql_result($query,0) == 1) ? true : false;
}

function user_id_from_username($Username){
	$Username = sanitize($Username);
	$query = mysql_query("SELECT `MemberID` FROM `members` WHERE `Username` = '$Username'");
	return mysql_result($query,0,'MemberID');
}

function login($Username,$Password){
	$MemberID = user_id_from_username($Username);
	$Username = sanitize($Username);
	$Password = md5($Password);
	$query = mysql_query("SELECT COUNT(`MemberID`) FROM `members` WHERE `Username` = '$Username' AND `Password` = '$Password'");
	return (mysql_result($query,0) == 1) ? $MemberID : false;
}

function allUsers(){
	return mysql_query("SELECT * FROM `members` WHERE `MemberType` != 'Admin'");

}

function vin_exists($VIN){
	//This checks if a VIN is already in use
	$VIN = sanitize($VIN);
	$query = mysql_query("SELECT COUNT(`VIN`) FROM `cars` WHERE `VIN` = '$VIN'");
	return (mysql_result($query,0) == 1) ? true : false;
}

function add_car($car_data){
	array_walk($car_data, 'array_sanitize');
	$fields = '`' . implode('`, `', array_keys($car_data)) . '`';
	$data = '\'' . implode('\', \'', $car_data) . '\'';
	$test = mysql_query("INSERT INTO `cars` ($fields) VALUES ($data)");
	#if (!$test){
		#echo mysql_error();
	#}
}

function getUserReservationHistory($MemberID,$date){
	$data = mysql_query("SELECT `VIN`,`ReservationDate`, `ReturnStatus`, `OdometerBefore`, `OdometerAfter`, `AdminComment` FROM `reservation` WHERE `MemberID` = $MemberID AND OdometerBefore IS NOT NULL AND OdometerAfter IS NOT NULL");
	return $data;
}
?>
