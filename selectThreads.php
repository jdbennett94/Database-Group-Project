<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>selectThreads.php</title>
  </head>
  <style>
  table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
  }

  tr:nth-child(even) {
    background-color: #dddddd;
  }
  </style>
  <body>

<h1>selectThreads.php</h1>

<?php
//MYSQL connection
require_once 'config.php';
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
//Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}

//Enters post info into variable
$searchTag = $_POST['searchTag'];


//Query statement array
$sql = "SELECT * from Threads where tags like '%$searchTag%'";
$result = $mysqli->query($sql);

//Html table format see below commented out portion for example
echo "<table style='width:100%; text-align:center'>";
echo "<tr>
      <th>ThreadId</th>
      <th>Thread Body</th>
      <th>Thread Name</th>
      <th>Thread Date</th>
      </tr>";

//Each row of table now
while ($row = $result->fetch_assoc()) { //for each thread

    //Decode Json thread data
    $thread = ($row['thread']);

    // Use json_decode() function to
    // decode a string
    $obj = json_decode($thread);

    $postArray = $obj->posts;

    $length = count($postArray);
    $html = "";
    for ($x = 0; $x < $length; $x++) { //for each post in a thread

      //Beginning of row
      $html .= "<tr>";

      //Thread id index
      $html .= "<td>";
      $html .= $row['id'];
      $html .= "</td>";

      $html .= "<td>";
      $html .= $postArray[$x]->body;
      $html .= "</td>";
      $html .= "<td>";
      $html .= $postArray[$x]->name;
      $html .= "<td>";
      $html .= $postArray[$x]->datePosted;
      $html .= "</td>";


      //End of row
      $html .= "</tr>";
    }
    echo $html;
}
//End of table
echo "</table> ";

?>
  </body>
</html>
