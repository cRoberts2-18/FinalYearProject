<!DOCTYPE html>
<html>
<style>

table{
        border: 1px solid black;
        border-collapse: collapse;
}

td, th {
        border: 1px solid black;
        text-align: center;
        padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
tr:nth-child(odd) {
  background-color: #ffffff;
}


</style>
<body>

<?php
$servername = "localhost";
$username = "phpmyadmin";
$password = "123123";
$dbname = "Weather";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

echo "<table width=\"100%\">";
echo"<tr><th>Date</th><th>Temperature</th><th>Max Temp</th><th>Min Temp</th><th>Rain</th></tr>";

$sql = "SELECT * FROM Readings  ORDER BY `Readings`.`Date` DESC";
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

</body>
</html>
