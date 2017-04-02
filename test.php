<?php
include 'Core/init.php';
include 'Includes/Overall/header.php';
?>

<!DOCTYPE HTML>
<html>
  <script src="https://code.jquery.com/jquery-3.2.0.min.js" integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I=" crossorigin="anonymous"></script>
  <script type="text/javascript">
  /**function searchLocation(str){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("location-list").innerHTML = this.responseText;
      };
    };
    xmlhttp.open("GET", "query.php?q=" + str, true);
    xmlhttp.send();
    return false;
  };**/
  function searchLocation(str) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("location-list").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "query.php?q=" + str, true);
    xmlhttp.send();
  }
  </script>
  <head>
      <title>Welcome to mysite</title>

  </head>
<body>
  <div>
    <h4>Select a car type:</h4>
    <ul id = "car-type-list">
      <?php
      $results = mysqli_query($con,"SELECT * FROM CarType");
      while ($row=mysqli_fetch_row($results)){
        printf( "<li><a href='#' onclick='searchLocation(\"%s\")''>%s</a></li>",$row[0],$row[0]);
      }
      ?>
    </ul>
  </div>
  <div>
    <h4>Location Results:</h4>
    <ul id = "location-list">
    </ul>
  </div>
</body>
</html>



<?php include 'Includes/Overall/footer.php'; ?>
