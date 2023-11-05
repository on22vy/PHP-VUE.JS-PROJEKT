<?php
/**
 * @author Thi Tuong Vy Nguyen <thi.nguyen.22@lehre.mosbach.dhbw.de>
 */
    header('Access-Control-Allow-Origin: *');  
    require_once('dbconnect.php');
    
    if (move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/".$_FILES['file']['name'])) {
        $filename = $_FILES['file']['name'];
        $filesize = $_FILES['file']['size'];
        $path_to_file = "uploads/" . $filename; // Set the file path
        $created_date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO files (filename, filesize, created_date, path_to_file) VALUES (?, ?, ?, ?)";
        
        $test = $mysql->prepare($sql);
        $test->bind_param("siss", $filename, $filesize, $created_date, $path_to_file);

        if ($test->execute()) {
            echo "Data inserted successfully!";
        } else {
            echo "Failed to insert data: " . $test->error;
        }

    }else{
        echo "Failed to move data"; 
    } 
    
  
?>