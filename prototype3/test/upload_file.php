<?php
//   $allowedExts = array("zip","tcx","gpx");
//   $temp = explode(".", $_FILES["file"]["name"]);
//   $extension = end($temp);

//   echo $_FILES["file"]["type"];

//   if ($_FILES["file"]["type"] == "application/zip" && $_FILES["file"]["size"] < 50000000 && in_array($extension, $allowedExts))
//   {
//     if ($_FILES["file"] && $_FILES["file"]["error"] > 0)
//     {
//       echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
//     }else
//     {
//       echo "Upload: " . $_FILES["file"]["name"] . "<br>";
//       echo "Type: " . $_FILES["file"]["type"] . "<br>";
//       echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
//       echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

//       if (file_exists("upload/" . $_FILES["file"]["name"]))
//       {
//         echo $_FILES["file"]["name"] . " already exists. ";
//       }else
//       {
//         if (!file_exists('upload')) {
//           mkdir('upload', 0777, true);
//         }
//         move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
//         echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
//       }
//     }
//   }else
//   {
//       echo "Invalid file";
//   }


//Loop through each file
for($i=0; $i<count($_FILES['upload']['name']); $i++) {

  date_default_timezone_set("Europe/Berlin"); 
  $formatteddate = date("Y-m-d H:i:s");

  $directory = "./upload/" . $formatteddate . "/";

  mkdir($directory, 0777, true);

  //Get the temp file path
  $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

  echo "Tak for din deltagelse :-)";

  //Make sure we have a filepath
  if ($tmpFilePath != ""){

    //Setup our new file path
    $newFilePath = $directory . $_FILES['upload']['name'][$i];

    //Upload the file into the temp dir

    if(move_uploaded_file($tmpFilePath, $newFilePath)) {

      // echo $$newFilePath;

    }
  }
}

?>