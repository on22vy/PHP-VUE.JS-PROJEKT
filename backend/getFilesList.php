<?php
/**
 * @author Thi Tuong Vy Nguyen <thi.nguyen.22@lehre.mosbach.dhbw.de>
 */
require_once('dbconnect.php');

$sql = "SELECT * FROM files";
$query = $mysql->query($sql);
$files = array();

while($row = mysqli_fetch_assoc($query)){
    $files[] = $row;
}

echo json_encode($files, JSON_PRETTY_PRINT);
exit;

?>
