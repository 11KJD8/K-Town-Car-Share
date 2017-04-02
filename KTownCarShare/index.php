<?php
include 'Core/init.php';
logged_in_redirect();
include 'Includes/Overall/header.php';
?>

<div id="index1">
	<img id="" src="Pictures/indexPage1.jpg">
	<a id="join_now" href="register.php">join now</a>
</div>

<div class="index2">
	<div class="left-pic">
		<img alt="image" id="car" src="Pictures/index2.png">
	</div>
	<div class="right-text">
		<ul>
			<li>Drive a car for up to a whole day</li>
			<li>Locaitons across the city.</li>
			<li>Save money compared to car ownership.</li>
			<li>Choose from sedans, hybrids, vans and more.</li>
		</ul>
	</div>
	<div class="clear"></div>
</div>



			
<div id="index3">
</div>


<!--<h1>Home</h1>
<p>Just a template</p>-->
<?php
/**if(isset($_SESSION['MemberID'])){
	echo 'Logged in';
	include 'Includes/loggedin.php';
}else{
	echo 'Not logged in';
}
include 'Includes/Widgets/user_count.php';
**/
?>



<?php include 'Includes/Overall/footer.php'; ?>