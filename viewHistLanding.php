<?php
//Member ID to send to next page
session_start();
$_SESSION['memID'] = 1;
?>
<!DOCTYPE HTML>
<html>
  <script src="https://code.jquery.com/jquery-3.2.0.min.js" integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I=" crossorigin="anonymous"></script>
  <script type="text/javascript">
  function viewHistory() {
    window.location="history.php";
  }
  </script>
  <head>
      <title>Welcome to mysite</title>

  </head>
<body>
  <div>
     <?php printf("<button onclick='viewHistory()'>View History</button>"); ?>
  </div>
</body>
</html>
