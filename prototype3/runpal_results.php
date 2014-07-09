<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/gif" href="assets/favicon.gif">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="fonts/MyFontsWebfontsKit/MyFontsWebfontsKit.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    
    <title>
      RunPal
    </title>
  </head>
  
  <!-- Container start -->
  
  <div class="content-container">
    
    
    <!-- Header -->
    
    <body>
      <div class="col-md-12 col-xl-12 col-xs-12 header" id="top">
        <h1 class="">
          Contact a Run Pal
        </h1>
      </div>

<?php
//get distance between two location points
function distance($lat1, $lon1, $lat2, $lon2, $unit) {

  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == "K") {
    return ($miles * 1.609344);
  } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
        return $miles;
      }
}

// echo distance(32.9697, -96.80322, 29.46786, -98.53506, "M") . " Miles<br>";
// echo distance(32.9697, -96.80322, 29.46786, -98.53506, "K") . " Kilometers<br>";

?>
  
<div class="col-md-12 section-wrapper2 center">
  
  <!-- <h3>
    Show Run Pals from ...
  </h3> -->
 <!--  <a id="all" href="runpal_results.php">
    <button class="btn btn-primary btn-sm">
      Everywhere
    </button>
  </a> -->
  
  <!-- Select unique cities and add button -->
  
  <div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
      Choose city
      <span class="caret">
      </span>
    </button>
    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
      <form method="post">
      <li role="presentation"><input type="submit" name="city" value="All cities"/><a role="menuitem" tabindex="-1" href="#"></a></li>

<?php 
    // $connection = mysql_connect('localhost', 'root', 'root'); //The Blank string is the password
    //     mysql_select_db('runpal');

        // Deployed connection to database
    $connection = mysqli_connect("localhost", "i72322", "29Sushi98", "runpal_org_01");

    $query = "SELECT * FROM Runpal group by city order by city ASC"; //You don't need a ; like you do in SQL
    $result = mysql_query($query);    
    $num_rows = mysql_num_rows($result);
    // $city_nospace = str_replace(' ', '', $row['city']);
    // $city_nocaps = strtolower($city_nospace);


    while($row = mysql_fetch_array($result)){
          if(strlen($row['city']) > 0){
            // $city_nospace = str_replace(' ', '', $row['city']); // replace spaces
            // $city_nocaps = strtolower($city_nospace); // replace caps
            echo "<li><input type='submit' name='city' value='" . $row['city'] . "' role='presentation'><a role='menuitem' tabindex='-1' href='#'/></a></li>";
          }
          };
     mysql_close(); //Make sure to close out the database connection      
?>
      </form>
    </ul>
  </div>
</div>

<?php
    // localhost
    // $connection = mysql_connect('localhost', 'root', 'root'); //The Blank string is the password
    //     mysql_select_db('runpal');
    
    // Deployed connection to database
    $connection = mysqli_connect("localhost", "i72322", "29Sushi98", "runpal_org_01");

    $city = $_POST['city'];
    // $query = "SELECT * FROM Runpal WHERE city= " .$city; //You don't need a ; like you do in SQL:: where city=post
    
    if($city == "All cities") {
      $query = "SELECT * FROM Runpal";
    }else {
      $query = "SELECT * FROM Runpal WHERE city = '" .$city. "'";
    };

    $result = mysql_query($query);
    $num_rows = mysql_num_rows($result);
    
    // echo "<table>"; // start a table tag in the HTML

    // Set male/female placeholder images  
    $img_male = 'assets/male.jpg';
    $img_female = 'assets/female.jpg';  


    while($row = mysql_fetch_array($result)){   //Creates a loop to loop through results
        if(strlen($row['city']) > 1){
            $url = "http://maps.google.com/maps/api/geocode/json?address=" . rtrim($row['city']) . "&sensor=false";
            $response = file_get_contents($url);
            $response = json_decode($response, true);

            //print_r($response);

            $lat = $response['results'][0]['geometry']['location']['lat'];
            $long = $response['results'][0]['geometry']['location']['lng'];

            // set img name for each user
            $imgname = str_replace(' ', '', $row['name']);  

            // Check if profile img exists - if not use male/female placeholder img
            $filename = 'assets/' . $imgname . '.jpg';
              if (file_exists($filename)) {
              $profile_img ='assets/' . $imgname . '.jpg';
              }else {
              if ($row['sex'] = 'male'){
              $profile_img = $img_male;
              } else {
                $profile_img = $img_female;
              }
              };

            echo "<div class='section-wrapper2 col-md-4 col-xl-4 col-xs-12'>";
           
              echo "<ul>";

            // echo "<tr>";
                echo "<li>" . "<h3>" . $row['name'] . "</h3>" . "</li>";
                // echo "<li>" . "sex:&nbsp;" . $row['Sex'] . "</li>";

                // loot to see if img has been uploaded

                // else if no img. has been uloaded check if sex male or female

                // if ($row['Sex']=="male"){
                //   $img_use = $img_male;
                // }else {
                //   $img_use = $img_female;
                // };

                echo "<li>" . "<img class='img-responsive'src=$profile_img>" . "</li>";
                echo "<li>" . "<strong>Age:</strong>&nbsp;" . $row['age'] . "</li>";
                echo "<li>" . "City:&nbsp;" . $row['city'] . "</li>";
                echo "<li>" . "Usually starting from:&nbsp;" . $row['zip'] . "</li>";

                if ($row['day1'] == 1){
                  $row['day1'] = "Mon";
                }else if($row['day1'] == 0){
                  $row['day1'] = "";
                };

                if ($row['day2'] == 1){
                  if ($row['day1'] <> ""){
                  $row['day2'] = ",&nbsp;Tue";
                }else {
                  $row['day2'] = "Tue";
                } 
                }else if ($row['day2'] == 0){
                  $row['day2'] = "";
                };

                if ($row['day3'] == 1){
                  if ($row['day1'] or $row['day2'] <> ""){
                  $row['day3'] = ",&nbsp;Wed";
                }else {
                  $row['day3'] = "Wed";
                } 
                }else if ($row['day3'] == 0){
                  $row['day3'] = "";
                };

                if ($row['day4'] == 1){
                  if ($row['day1'] or $row['day2'] or $row['day3'] <> ""){
                  $row['day4'] = ",&nbsp;Thu";
                }else {
                  $row['day4'] = "Thu";
                } 
                }else if ($row['day4'] == 0){
                  $row['day4'] = "";
                };

                if ($row['day5'] == 1){
                  if ($row['day1'] or $row['day2'] or $row['day3'] or $row['day4'] <> ""){
                  $row['day5'] = ",&nbsp;Fri";
                }else {
                  $row['day5'] = "Fri";
                } 
                }else if ($row['day5'] == 0){
                  $row['day5'] = "";
                };

                if ($row['day6'] == 1){
                  if ($row['day1'] or $row['day2'] or $row['day3'] or $row['day4'] or $row['day5'] <> ""){
                  $row['day6'] = ",&nbsp;Sat";
                }else {
                  $row['day6'] = "Sat";
                } 
                }else if ($row['day6'] == 0){
                  $row['day6'] = "";
                };

                if ($row['day7'] == 1){
                  if ($row['day1'] or $row['day2'] or $row['day3'] or $row['day4'] or $row['day5'] or $row['day6'] <> ""){
                  $row['day7'] = ",&nbsp;Sun";
                }else {
                  $row['day7'] = "Sun";
                } 
                }else if ($row['day7'] == 0){
                  $row['day7'] = "";
                };

                echo "<li>" . "Days:&nbsp;" . $row['day1'] . $row['day2'] . $row['day3'] . $row['day4'] . $row['day5'] . $row['day6'] . $row['day7'] . "</li>";
               
                echo "<li>" . "Between:&nbsp;" . $row['time1'] . "&nbsp; and &nbsp;". $row['time2'] . "</li>"; 

                if ($row['dist1'] == 1){
                  $row['dist1'] = "Less than 5 k";
                }else if($row['dist1'] == 0){
                  $row['dist1'] = "";
                };

                if ($row['dist2'] == 1){
                  if($row['dist1'] <> ""){
                  $row['dist2'] = ",&nbsp;less than 10 k";
                }else if($row['dist1'] == 0){
                  $row['dist2'] = "Less than 10 k";
                }
                }else if ($row['dist2'] == 0){
                  $row['dist2'] = "";
                };

                if ($row['dist3'] == 1){
                  if(($row['dist2'] or $row['dist1']) <> ""){
                  $row['dist3'] = ",&nbsp;more than 10 k";
                }else {
                  $row['dist3'] = "More than 10 k";
                }
                }else if ($row['dist3'] == 0){
                  $row['dist3'] = "";
                };

                echo "<li>" . "Distances:&nbsp;" . $row['dist1'] . $row['dist2'] . $row['dist3'] . "</li>"; 

                if ($row['pace1'] == 1){
                  $row['pace1'] = "Less than 4:30 min/km";
                }else {
                  $row['pace1'] = "";
                };
                
                if ($row['pace2'] == 1){
                  if($row['pace1'] <> ""){
                  $row['pace2'] = ",&nbsp;less than 5:30 min/km";
                }else {
                  $row['pace2'] = "Less than 5:30 min/km";
                }
                }else if ($row['pace2'] == 0){
                  $row['pace2'] = "";
                };

                if ($row['pace3'] == 1){
                  if(($row['pace2'] or $row['pace1']) <> ""){
                  $row['pace3'] = ",&nbsp;more than 5:30 min/km";
                }else {
                  $row['pace3'] = "More than 5:30 min/km";
                }
                }else if ($row['pace3'] == 0){
                  $row['pace3'] = "";
                };

                echo "<li>" . "Paces:&nbsp;" . $row['pace1'] . $row['pace2'] . $row['pace3'] . "</li>";  

                echo "<li>" . "Goal with running:&nbsp;" . $row['goal'] . "</li>";

                echo "<li>" . "<a href='mailto:" . $row['email'] . "?subject=Run together?&body=Hey " . $row['name'] . "! Our profiles on Run Pal match - let us go for a run together!'><button class='btn btn-primary btn-sm'>Contact</button></a>" . "</li>";

                echo "</ul>";
            //     // echo "<li>latitude: " . $lat . " longitude: " . $long . "</li>";
            //  echo "</tr>";  //$row['index'] the index here is a field name
                echo "</div>";
             
        }else
        {
            // echo "<tr>";
            //     // echo "<li>" . $row['name'] . "</li>";
            //     // echo "<li>" . $row['age'] . "</li>";
            // echo "</tr>";  //$row['index'] the index here is a field name
        }
    }

    // echo "</table>"; //Close the table in HTML

    mysql_close(); //Make sure to close out the database connection


?>
      <form action="insert2.php" method="post">
       
        <div class="section-wrapper2 col-md-4 col-xl-4 col-xs-12">
          <h3>What do you think about <br> the Run Pal concept?</h3> 
          <input class="form-control" type="text" textarea rows="10" name="feedback" placeholder="Enter your anonymous feedback">
        <br>

        <!-- submit--> 

        <p><button class="btn btn-primary btn-lg col-md-12 col-xl-12 col-xs-12" input type="submit"><h2>Submit feedback</h2></button></p>
        </div>
      </form>
    </body>
  </div>
</html>