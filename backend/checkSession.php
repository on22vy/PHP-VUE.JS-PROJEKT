<?php
/**
 * @author Thi Tuong Vy Nguyen <thi.nguyen.22@lehre.mosbach.dhbw.de>
 */
// Start the session to access session variables
session_start();

// Check if a session exists
if (isset($_SESSION['user'])) {
    // If true, return existing user data saved in global session variable 'user' as a JSON response
    echo json_encode(['user' => $_SESSION['user']]);
} else {
    // If no session exists, return user data as null
    echo json_encode(['user' => null]);
}
?>
