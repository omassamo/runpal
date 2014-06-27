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

if (!mysqli_query($con,$sql)) {
  die(' Error: ' . mysqli_error($con));
}
// echo "Thanks for your feedback!";

// // url for localhost
// header( 'Location: http://localhost:8888/runpal/runpal3.html' ) ;

// url for Deployed
header( 'Location: http://runpal.org/runpal3.html' ) ;

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