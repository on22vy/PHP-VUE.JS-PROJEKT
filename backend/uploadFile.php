<?php
/**
 * @author Thi Tuong Vy Nguyen <thi.nguyen.22@lehre.mosbach.dhbw.de>
 */
    header('Access-Control-Allow-Origin: *');  

    // Including the database connection file
    require_once('dbconnect.php');
    
    // Checking if the file was successfully uploaded: Check if the file was successfully moved from the temporary directory to the desired destination
    if (move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/".$_FILES['file']['name'])) {
        // Extracting information about the uploaded file
        $filename = $_FILES['file']['name'];
        $filesize = $_FILES['file']['size'];
        $path_to_file = "uploads/" . $filename; // Set the file path
        $created_date = date('Y-m-d H:i:s');

        // SQL query to insert file information into the database
        $sql = "INSERT INTO files (filename, filesize, created_date, path_to_file) VALUES (?, ?, ?, ?)";
        
        // Preparing and binding parameters for the SQL query
        $test = $mysql->prepare($sql);
        $test->bind_param("siss", $filename, $filesize, $created_date, $path_to_file);

        // Executing the prepared SQL query
        if ($test->execute()) {
            echo "Data inserted successfully!";
        } else {
            echo "Failed to insert data: " . $test->error;
        }

    }else{
        echo "Failed to move data";  // Output message if file upload fails
    } 
    
  
?>