<?php
// Localhost connection to database
$con = mysqli_connect("localhost", "root", "12345", "test");

// Deployed connection to database
// $con = mysqli_connect("localhost", "i72322", "29Sushi98", "runpal_org_01");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// escape variables for security
$name = mysqli_real_escape_string($con, $_POST['name']);
$age = mysqli_real_escape_string($con, $_POST['age']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$sex = mysqli_real_escape_string($con, $_POST['sex']);
$day1 = mysqli_real_escape_string($con, $_POST['day1']);
$day2 = mysqli_real_escape_string($con, $_POST['day2']);
$day3 = mysqli_real_escape_string($con, $_POST['day3']);
$day4 = mysqli_real_escape_string($con, $_POST['day4']);
$day5 = mysqli_real_escape_string($con, $_POST['day5']);
$day6 = mysqli_real_escape_string($con, $_POST['day6']);
$day7 = mysqli_real_escape_string($con, $_POST['day7']);
$time1 = mysqli_real_escape_string($con, $_POST['time1']);
$time2 = mysqli_real_escape_string($con, $_POST['time2']);
$city = mysqli_real_escape_string($con, $_POST['city']);
$zip = mysqli_real_escape_string($con, $_POST['zip']);
$pace1 = mysqli_real_escape_string($con, $_POST['pace1']);
$pace2 = mysqli_real_escape_string($con, $_POST['pace2']);
$pace3 = mysqli_real_escape_string($con, $_POST['pace3']);
$dist1 = mysqli_real_escape_string($con, $_POST['dist1']);
$dist2 = mysqli_real_escape_string($con, $_POST['dist2']);
$dist3 = mysqli_real_escape_string($con, $_POST['dist3']);
$info1 = mysqli_real_escape_string($con, $_POST['info1']);
$info2 = mysqli_real_escape_string($con, $_POST['info2']);
$info3 = mysqli_real_escape_string($con, $_POST['info3']);

$sql="INSERT INTO Runpal (name, age, email, sex, day1, day2, day3, day4, day5, day6, day7, time1, time2, city, zip, pace1, pace2, pace3, dist1, dist2, dist3, info1, info2, info3)
VALUES ('$name', '$age', '$email', '$sex', '$day1', '$day2', '$day3', '$day4', '$day5', '$day6', '$day7', '$time1', '$time2', '$city', '$zip', '$pace1', '$pace2', '$pace3','$dist1','$dist2','$dist3', '$info1', '$info2', '$info3')";

// if(isset($_POST['day'])) {
// $day = implode(",", $_POST['day']);   
// } else {
// $day = "";
// }

if (!mysqli_query($con,$sql)) {
  die(' Error: ' . mysqli_error($con));
}
// echo "1 record added";

// url for localhost
header( 'Location: http://localhost:8888/runpal/runpal2.html' ) ;

// url for Deployed
// header( 'Location: http://runpal.org/runpal2.html' ) ;

mysqli_close($con);

?>