<?php
session_start();
$host = "localhost";
$db_name = "K-Town Car Share";
$username = "root"; // use your own username and password if different from mine
$password = "HMz6ZEGWrhDt7cTa";
$con=mysqli_connect($host,$username,$password,$db_name);
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$memID = $_SESSION['memID'];
?>
<!DOCTYPE HTML>
<html>
  <script src="https://code.jquery.com/jquery-3.2.0.min.js" integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I=" crossorigin="anonymous"></script>
  <script type="text/javascript">
  </script>
  <head>
      <title>Welcome to mysite</title>

  </head>
<body>
  <div>
     <?php
      $query = "SELECT * FROM Reservation WHERE MemberID='$memID'";
      $results = mysqli_query($con,$query);
      while ($row=mysqli_fetch_row($results)){
        printf("<li> %s %s %s</li>", $row[0],$row[1],$row[2]);
      }
     ?>
  </div>
</body>
</html>
