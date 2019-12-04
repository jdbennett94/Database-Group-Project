<?php

require_once 'config.php';
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}

$post->body = $_POST["body"];
$post->name = $_POST["userName"];
#$post->id = $_POST["threadId"];
$post->datePosted = date("Y-m-d");
$sql = "SELECT * FROM Threads WHERE id = ". $_POST["threadId"];

$result = $mysqli->query($sql);

$row = $result->fetch_assoc();
$thread = json_decode($row['thread']);
$postArray = $thread->posts;
$postArray[] = $post;

 $thread->posts = $postArray;

 $newThreadJSON = json_encode($thread);

$sql = "UPDATE Threads SET thread = '".$newThreadJSON."' WHERE `Threads`.`id` =".$_POST["threadId"];

  if ($mysqli->query($sql) === TRUE) {
      $htmlOutput .= "Thread updated successfully";
  }
  else{
    $htmlOutput .= "Insertion Failed: ".$sql." ".$mysqli->error;

  }
  echo $htmlOutput;
?>
