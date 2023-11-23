<?php
/**
 * @author Thi Tuong Vy Nguyen <thi.nguyen.22@lehre.mosbach.dhbw.de>
 */
// Start the session to access session variables
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

die();
?>