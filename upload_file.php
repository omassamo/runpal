<?php
  $allowedExts = array("zip");
  $temp = explode(".", $_FILES["file"]["name"]);
  $extension = end($temp);

  echo $_FILES["file"]["type"];

  if ($_FILES["file"]["type"] == "application/zip" && $_FILES["file"]["size"] < 50000000 && in_array($extension, $allowedExts))
  {
    if ($_FILES["file"] && $_FILES["file"]["error"] > 0)
    {
      echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }else
    {
      echo "Upload: " . $_FILES["file"]["name"] . "<br>";
      echo "Type: " . $_FILES["file"]["type"] . "<br>";
      echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
      echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

      if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
        echo $_FILES["file"]["name"] . " already exists. ";
      }else
      {
        if (!file_exists('upload')) {
          mkdir('upload', 0777, true);
        }
        move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
        echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
      }
    }
  }else
  {
      echo "Invalid file";
  }
?>
