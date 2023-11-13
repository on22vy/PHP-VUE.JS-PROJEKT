<?php 
/**
 * @author Thi Tuong Vy Nguyen <thi.nguyen.22@lehre.mosbach.dhbw.de>
 */
    session_start();
    include("dbconnect.php");

    $out = array('error' => false);
 
    $username = $_POST['username'];
    $password = $_POST['password'];

     
    if($username==''){
        $out['error'] = true;
        $out['message'] = "Username is required";
    }
    else if($password==''){
        $out['error'] = true;
        $out['message'] = "Password is required";
    }
    else{
        $sql = "select * from users where username='$username' and password='$password'";
        $query = $mysql->query($sql);
    
        if($query->num_rows>0){
            $row=$query->fetch_array();
            $_SESSION['user']=$row['id'];
            $out['message'] = "Login Successful. Redirecting...";
        }
        else{
            $out['error'] = true;
            $out['message'] = "Login Failed. User not Found";
        }
    }
        
    $mysql->close();

    header("Content-type: application/json");
    echo json_encode($out);
    die();
    ?>


?>