<?php

require_once 'config.php';
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}

$post->body = $_POST["body"];
$post->name = $_POST["userName"];
$post->id = $_POST["threadId"];
#$post->datePosted = date("Y-m-d");




$sql = "SELECT * FROM Donor WHERE donorId = ". $_GET["id"];

    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();


  $thread = $row['thread'];
  echo $thread;
/*
$sql .= 'UPDATE Threads SET thread = '.' \''.$threadJSON.'\' WHERE id = '.$_POST["threadId"].');';

  if ($mysqli->query($sql) === TRUE) {
      $htmlOutput .= "Thread added successfully";
  }
  else{
    $htmlOutput .= "Insertion Failed: ". $mysqli->error;

  }
  echo $htmlOutput;*/
?>
