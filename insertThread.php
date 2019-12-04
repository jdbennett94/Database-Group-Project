<?php

#The object should have the following keys (and appropriate values):body, name (of user), datePosted (you can retrieve it in your PHP)



$thread->body = $_POST["body"];
$thread->name = $_POST["user"];
$thread->datePosted = date("Y-m-d");

$threadJSON = json_encode([$thread]);


#$tagsJSON = json_encode([$_POST["tag1"],$_POST["tag2"],$_POST["tag3"],$_POST["tag4"],$_POST["tag5"]]);





echo $myJSON;






?>
