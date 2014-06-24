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

echo distance(32.9697, -96.80322, 29.46786, -98.53506, "M") . " Miles<br>";
echo distance(32.9697, -96.80322, 29.46786, -98.53506, "K") . " Kilometers<br>";

?>


<?php
    $connection = mysql_connect('localhost', 'root', 'root'); //The Blank string is the password
    mysql_select_db('runpal');

    $query = "SELECT * FROM Runpal"; //You don't need a ; like you do in SQL
    $result = mysql_query($query);

    echo "<table>"; // start a table tag in the HTML

    while($row = mysql_fetch_array($result)){   //Creates a loop to loop through results
        if(strlen($row['city']) > 1){
            $url = "http://maps.google.com/maps/api/geocode/json?address=" . rtrim($row['city']) . "&sensor=false";
            $response = file_get_contents($url);
            $response = json_decode($response, true);

            //print_r($response);

            $lat = $response['results'][0]['geometry']['location']['lat'];
            $long = $response['results'][0]['geometry']['location']['lng'];

            echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['age'] . "</td>";
                echo "<td>" . $row['city'] . "</td>";
                echo "<td>latitude: " . $lat . " longitude: " . $long . "</td>";
             echo "</tr>";  //$row['index'] the index here is a field name
        }else
        {
            echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['age'] . "</td>";
            echo "</tr>";  //$row['index'] the index here is a field name
        }
    }

    echo "</table>"; //Close the table in HTML

    mysql_close(); //Make sure to close out the database connection



?>
