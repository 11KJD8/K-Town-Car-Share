<?php
include 'Core/init.php';
redirect_to_login();
include 'Includes/Overall/header.php';
?>
<script>
	function addComment(){
		var comment = document.getElementById("textArea").value;
		console.log(comment);
		var query = window.location.search.substring(1);
		var vars = query.split("&");
		//console.log(vars);
		var str = "UPDATE reservation SET AdminComment = '"+comment+"' WHERE ReservationDate = '"+vars[2].split("=")[1]+"' AND MemberID = '"+vars[0].split("=")[1]+"' AND VIN = '"+vars[1].split("=")[1]+"'";
		console.log(str);
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				window.location = "comments.php";
			}
		};
		xmlhttp.open("GET", "ajax_reply_query.php?query=" + str, true);
		xmlhttp.send();
	}
</script>

<div id="replyComment">
	<h2>Reply to comment</h2>
	<textarea id="textArea" rows="4" cols="50" placeholder="Comment" required>
	</textarea>
	<br>
	
	<input onclick="addComment()" type="submit">
	
</div>
<?php include 'Includes/Overall/footer.php'; ?>