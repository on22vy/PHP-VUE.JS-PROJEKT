<?php
/**
 * @author Thi Tuong Vy Nguyen <thi.nguyen.22@lehre.mosbach.dhbw.de>
 */
session_start();
include("dbconnect.php");

if (!isset($_SESSION['user']) || (empty($_SESSION['user']))) {
    header('location: http://localhost:8000/'); // Redirect to the login page if the user is not authenticated.
}

$sql = "select * from users where id='" . $_SESSION['user'] . "'";
$query = $mysql->query($sql);
$row = $query->fetch_array();

// Return the user data as JSON response, including the username.
$response = ['username' => $row['username']];
echo json_encode($response);
?>
