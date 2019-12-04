<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>selectThreads.php</title>
  </head>
  <body>

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
echo "<table style='width:100%; text-align:center; border:1px'>";
echo "<tr>
      <th>ThreadId</th>
      <th>Thread</th>
      </tr>";

//Each row of table now
while ($row = $result->fetch_assoc()) {

    //Decode Json thread data
    $thread = json_decode($row['thread']);

    //Beginning of row
    echo "<tr>";

    //Thread id index
    echo "<td>";
    echo $row['id'];
    echo "</td>";

    //Thread itself index
    echo "<td>";
    echo $thread; //This is a dictionary not a string
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
