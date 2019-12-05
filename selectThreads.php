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

#this thread works but not ideal, ex. if the tag is 'organ' this will still return things tagged "organizer"
#might need to grab all, decode each JSON, and loop over the resulting array

//Html table format see below commented out portion for example
echo "<table style='width:100%; text-align:center'>";
echo "<tr>
      <th>ThreadId</th>
      <th>Thread Body</th>
      <th>Thread Name</th>
      <th>Thread Date</th>
      </tr>";

//Each row of table now
while ($row = $result->fetch_assoc()) {

    //Decode Json thread data
    $thread = ($row['thread']);

    // Use json_decode() function to
    // decode a string
    $obj = json_decode($thread);
    $obj2 = json_decode($obj->{'posts'});

    //Beginning of row
    echo "<tr>";

    //Thread id index
    echo "<td>";
    echo $row['id'];
    echo "</td>";

    //Thread itself index
    echo "<td>";
    echo $obj2->{'body'};; //This is a dictionary not a string
    echo "</td>";

    //Thread itself index
    echo "<td>";
    echo $obj2->{'name'};; //This is a dictionary not a string
    echo "</td>";

    //Thread itself index
    echo "<td>";
    echo $obj2->{'datePosted'};; //This is a dictionary not a string
    echo "</td>";

    //End of row
    echo "</tr>";
}
//End of table
echo "</table> ";


/*  <tr>
    <th>Firstname</th>
    <th>Lastname</th>
    <th>Age</th>
  </tr>
  <tr>
    <td>Jill</td>
    <td>Smith</td>
    <td>50</td>
  </tr>
  <tr>
    <td>Eve</td>
    <td>Jackson</td>
    <td>94</td>
  </tr>
</table> "
*/
?>
  </body>
</html>
