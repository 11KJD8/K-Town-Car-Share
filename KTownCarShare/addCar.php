<?php
include 'Core/init.php';
redirect_to_login();
include 'Includes/Overall/header.php';
if(empty($_POST) === false){
	//Gets all the required fields.
	$required_fields = array('VIN', 'Make', 'Model', 'ModelYear', 'CarType', 'LocationID', 'TransType'); //More fields can be added
	foreach($_POST as $key=>$value){
		if(empty($value) && in_array($key, $required_fields) === true){
			$errors[] = 'All fields are required.';
			break 1;
		}
	}
	if(empty($errors) === true){
		//Validation for all the important fields
		if(vin_exists($_POST['VIN']) === true){
			$errors[] = 'Sorry, the VIN \'' . $_POST['VIN'] . '\' already exists.';
		}
	}
}
?>
<h1>Add Cars</h1>
<?php
if(isset($_GET['success']) === true && empty($_GET['success']) === false){
	echo 'Car has been added.';
}else{
	if(empty($_POST) === false && empty($errors) === true){
		$car_data = array(
			'VIN' 			=> $_POST['VIN'],
			'Make' 			=> $_POST['Make'],
			'ModelYear' 	=> $_POST['ModelYear'],
			'CarType' 		=> $_POST['CarType'],
			'PictureAddress' 		=> $_POST['PictureAddress'],
			'Model' 		=> $_POST['Model'],
			'LocationID' 	=> $_POST['LocationID'],
			'TransType' 	=> $_POST['TransType']
		);
		add_car($car_data);
		header('Location: addCar.php?success=True');
		exit();
	}else if(empty($errors) === false){
		echo output_errors($errors);
	}
	?>
	<form action="" method="post">
		<ul>
			<li>
				<input type="text" placeholder="VIN" name="VIN">
			</li>
			<li>
				<input type="text" placeholder="Make" name="Make">
			</li>
			<li>
				<input type="text" placeholder="Model" name="Model">
			</li>
			<li>
				<input type="text" placeholder="Model Year" name="ModelYear">
			</li>
			<li>
				<input type="text" placeholder="Car Type" name="CarType">
			</li>
			<li>
				<input type="text" placeholder="Picture Address" name="PictureAddress">
			</li>
			<li>
				<input type="text" placeholder="Location ID" name="LocationID">
			</li>
			<li>
				<input type="text" placeholder="Transmission" name="TransType">
			</li>
			<li>
				<input type="submit" value="Add Car">
			</li>
		</ul>
	</form>

	<?php
} 
include 'Includes/Overall/footer.php';
?>