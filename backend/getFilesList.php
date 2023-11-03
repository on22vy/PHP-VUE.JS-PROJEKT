
<?php
// header('Access-Control-Allow-Origin: *');
require_once('dbconnect.php');

// $out = array();
  
// $action = 'alldata';
  
// if(isset($_GET['action'])){
//     $action = $_GET['action'];
// }
  
  
// if($action == 'alldata'){
//     $sql = "select filename, filesize, created_date, path_to_file from files";
//     $query = $mysql->query($sql);
//     $files = array();
  
//     while($row = mysqli_fetch_array($query)){
//         array_push($files, $row);
//     }
  
//     $out['files'] = $files;
// }
  

$sql = "select * from files";
$query = $mysql->query($sql);
$files = array();

while($row = mysqli_fetch_assoc($query)){
    $files[] = $row;
}
  
    // $out['files'] = $files;

// header("Content-type: application/json");
echo json_encode($files, JSON_PRETTY_PRINT);
exit;
  

// $sql = "SELECT filename, path_to_file FROM files";
// $result = $mysql->query($sql);

// if ($result) {
//     $files = $result->fetch_all(MYSQLI_ASSOC);
//     echo json_encode($files);
// } else {
//     echo "Failed to retrieve files list: " . $mysql->error;
// }
?>
