<?php
if(isset($_POST['day'])) {
$day = implode(",", $_POST['day']);   
} else {
$day = "";
}
?>

<?php
$con = mysqli_connect("localhost", "root", "12345", "test");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// escape variables for security
$name = mysqli_real_escape_string($con, $_POST['name']);
$age = mysqli_real_escape_string($con, $_POST['age']);
$sex = mysqli_real_escape_string($con, $_POST['sex']);
$day = mysqli_real_escape_string($con, $_POST['day']);
$time1 = mysqli_real_escape_string($con, $_POST['time1']);
$time2 = mysqli_real_escape_string($con, $_POST['time2']);
$zip = mysqli_real_escape_string($con, $_POST['zip']);
$pace = mysqli_real_escape_string($con, $_POST['pace']);
$distance = mysqli_real_escape_string($con, $_POST['distance']);

$sql="INSERT INTO Runpal (name, age, sex, day, time1, time2, zip, pace, distance)
VALUES ('$name', '$age', '$sex', '$day', '$time1', '$time2', '$zip', '$pace', '$distance')";

if (!mysqli_query($con,$sql)) {
  die(' Error: ' . mysqli_error($con));
}
echo "1 record added";

mysqli_close($con);
?>