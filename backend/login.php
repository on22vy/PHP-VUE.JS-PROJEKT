<?php 
/**
 * @author Thi Tuong Vy Nguyen <thi.nguyen.22@lehre.mosbach.dhbw.de>
 */
    // Start a new or resume the existing PHP session
    session_start();

    // Include the database connection
    require_once("dbconnect.php");

    // Initialize an array to store response data
    $out = array('error' => false);
 
    // Retrieve the username and password from the POST request
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username is empty
    if($username==''){
        //If true, show error message to require username input
        $out['error'] = true;
        $out['message'] = "Username is required";
    }
    // Check if the password is empty
    else if($password==''){
        //If true, show error message to require password input
        $out['error'] = true;
        $out['message'] = "Password is required";
    }
    else{
        //In case both of username and password are not empty, construct an SQL query to check if the provided username and password match a user in the database
        $sql = "select * from users where username='$username' and password='$password'";
        // Execute the SQL query
        $query = $mysql->query($sql);
    
        // Check if any matching records were found
        if($query->num_rows>0){
            // If matching records were found, fetch the user's data
            $row=$query->fetch_array();
            // Set the user's ID to the global session variable 'user' and indicate successful login
            $_SESSION['user']=$row['id'];
            $out['message'] = "Login Successful. Redirecting...";
        }
        else{
            // If no matching records were found, indicate a login failure
            $out['error'] = true;
            $out['message'] = "Login Failed. User not Found";
        }
    }
     
    // Close the database connection
    $mysql->close();

    // Set the response content type to JSON
    header("Content-type: application/json");

    // Encode the response data as JSON and send it as the HTTP response
    echo json_encode($out);

    // Terminate the script
    die();
    ?>


?>