<?php

require_once 'config.php';
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}


#The object should have the following keys (and appropriate values):body, name (of user), datePosted (you can retrieve it in your PHP)

$tagsTemp = array(trim($_POST["tag1"]),trim($_POST["tag2"]),trim($_POST["tag3"]),trim($_POST["tag4"]),trim($_POST["tag5"]));
$tags= array();

for ($x = 0; $x < 5; $x++) {
    if ($tagsTemp[$x] != "") {
        $tags[]= $tagsTemp[$x];
    }
}

$tagsJSON = json_encode($tags);
$post->body = $_POST["body"];
$post->name = $_POST["user"];
$post->datePosted = date("Y-m-d");
$thread->posts = array($post);


$threadJSON = json_encode($thread);


$sql .= 'INSERT INTO Threads (tags, thread) VALUES'.' (\''.$tagsJSON.'\',\''.$threadJSON.'\');';

  if ($mysqli->query($sql) === TRUE) {
      $htmlOutput .= "Thread added successfully";
  }
  else{
    $htmlOutput .= "Insertion Failed: ". $mysqli->error;

  }
  echo $htmlOutput;
?>
