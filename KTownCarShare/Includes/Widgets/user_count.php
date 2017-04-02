<div>
	<h2>Users</h2>
	<div>
		<?php 
		$user_count = user_count();
		$suffix = ($user_count != 1) ? 's' : '';
		?>
		<p>We currently have <?php echo $user_count; ?> registered user<?php echo $suffix; ?>.</p>
	</div>
</div>