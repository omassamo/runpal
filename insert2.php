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
$feedback = mysqli_real_escape_string($con, $_POST['feedback']);

$sql="INSERT INTO Runpal (feedback)
VALUES ('$feedback')";

// if(isset($_POST['day'])) {
// $day = implode(",", $_POST['day']);   
// } else {
// $day = "";
// }

if (!mysqli_query($con,$sql)) {
  die(' Error: ' . mysqli_error($con));
}
echo "Thanks for your feedback!";

// // url for localhost
// header( 'Location: http://localhost:8888/runpal/runpal2.html' ) ;

// // url for Deployed
// // header( 'Location: http://runpal.org/runpal2.html' ) ;

mysqli_close($con);

?>