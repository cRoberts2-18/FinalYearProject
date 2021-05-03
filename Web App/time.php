<?php
$servername = "localhost";
$username = "phpmyadmin";
$password = "123123";
$dbname = "Weather";


$start = $_POST['start'];
$end = $_POST['end'];


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

echo "<table width=\"100%\">";
echo"<tr><th>Date</th><th>Temperature</th><th>Max Temp</th><th>Min Temp</th><th>Rain</th></tr>";

$sql = "SELECT * FROM `Readings` WHERE `Date` BETWEEN \"".$start."\" AND \"".$end."\"";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["Date"]."</td><td>".$row["Temperature"]."</td><td>".$row["Max Temp"]."</td><td>".$row["Min Temp"]."</td><td>".$row["Rain"]."</td></tr>";

  }
} else {
  echo "0 results";
}


echo "</table>";

?>
