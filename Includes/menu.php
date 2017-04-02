<nav id="nav1">
	<a href="#" id="navicon"><img src="Pictures/navicon.png" alt="Menu"></a>
	<ul>
		<li><a href="index.php">Home</a></li>
		<li><a href="contact.php">Contact Us</a></li>
	</ul>
</nav>
<nav id="nav2">
	<ul id="nav2">
		<li>
			<?php
				if(logged_in() === true){
					?>
					<a href="logout.php">Logout</a>
					<?php
				}else{
					?>
					<a href="login.php">Login</a>
					<?php
				}
			?>
		</li>
		<li><a id="join" href="register.php">Join!</a></li>
	</ul>
</nav>
