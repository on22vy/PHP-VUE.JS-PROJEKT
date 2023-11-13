<?php
/**
 * @author Thi Tuong Vy Nguyen <thi.nguyen.22@lehre.mosbach.dhbw.de>
 */
session_start();

// Check if a session exists
if (isset($_SESSION['user'])) {
    // Return user data as a JSON response
    echo json_encode(['user' => $_SESSION['user']]);
} else {
    // No session exists
    echo json_encode(['user' => null]);
}
?>
