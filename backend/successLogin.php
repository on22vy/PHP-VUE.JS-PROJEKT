<?php
/**
 * @author Thi Tuong Vy Nguyen <thi.nguyen.22@lehre.mosbach.dhbw.de>
 */
// Include the database connection
session_start();
// Include the database connection file
require_once("dbconnect.php");

// Check if the user is not authenticated (not logged in)
if (!isset($_SESSION['user']) || (empty($_SESSION['user']))) {
    header('location: http://localhost:8000/'); // Redirect to the login page if the user is not authenticated.
}

// Query the database to retrieve user data based on the session user ID
$sql = "select * from users where id='" . $_SESSION['user'] . "'";
$query = $mysql->query($sql);
$row = $query->fetch_array();

// Return the username as JSON response.
$response = ['username' => $row['username']];
echo json_encode($response);
?>
