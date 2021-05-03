<?php
$start = $_POST['start'];
$end = $_POST['end'];
$x =$_POST['x'];
$y =$_POST['y'];

$servername = "localhost";
$username = "phpmyadmin";
$password = "123123";
$dbname = "Weather";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM `Readings` WHERE `Date` BETWEEN \"".$start."\" AND \"".$end."\"";
$data[] = array($x,$y);
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
        array_push($data, array(date($row[$x]),(int)$row[$y]));
  }
} else {
  echo "0 results";
}

echo json_encode($data);

?>

