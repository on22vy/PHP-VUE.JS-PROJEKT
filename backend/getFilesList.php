<?php
/**
 * @author Thi Tuong Vy Nguyen <thi.nguyen.22@lehre.mosbach.dhbw.de>
 */
// Include the database connection
require_once('dbconnect.php');

// SQL query to select all existing/uploaded files from the database
$sql = "SELECT * FROM files";
$query = $mysql->query($sql);

// Create an array to store the files
$files = array();

//Fetch each row from the query result and add it to the $files array
while($row = mysqli_fetch_assoc($query)){
    $files[] = $row;
}

// Output the files array as JSON with pretty-printin
echo json_encode($files, JSON_PRETTY_PRINT);
exit;

?>
