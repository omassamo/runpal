<?php
// Localhost connection to database
// $con = mysqli_connect("localhost", "root", "root", "runpal");

// Deployed connection to database
$con = mysqli_connect("localhost", "i72322", "29Sushi98", "runpal_org_01");

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
$goal = mysqli_real_escape_string($con, $_POST['goal']);
$info1 = mysqli_real_escape_string($con, $_POST['info1']);
$info2 = mysqli_real_escape_string($con, $_POST['info2']);
$info3 = mysqli_real_escape_string($con, $_POST['info3']);
$feedback = mysqli_real_escape_string($con, $_POST['feedback']);

$sql="INSERT INTO Runpal (name, age, email, sex, day1, day2, day3, day4, day5, day6, day7, time1, time2, city, zip, pace1, pace2, pace3, dist1, dist2, dist3, goal, info1, info2, info3, feedback)
VALUES ('$name', '$age', '$email', '$sex', '$day1', '$day2', '$day3', '$day4', '$day5', '$day6', '$day7', '$time1', '$time2', '$city', '$zip', '$pace1', '$pace2', '$pace3','$dist1','$dist2','$dist3', '$goal' '$info1', '$info2', '$info3', '$feedback')";

// if(isset($_POST['day'])) {
// $day = implode(",", $_POST['day']);   
// } else {			
// $day = "";
// }

if (!mysqli_query($con,$sql)) {
  die(' Error: ' . mysqli_error($con));
}
echo "1 record added";

// url for localhost
header( 'Location: http://localhost:8888/runpal/runpal_results.php' ) ;

//  Berlin url for Deployed
// header( 'Location: http://runpal.org/runpal2.html' ) ;
//  CPH url for Deployed
// header( 'Location: http://runpal.org/runpalcph.html' ) ;

mysqli_close($con);

?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-47568451-1', 'runpal.org');
  ga('send', 'pageview');

</script>