<?php
/**
 * @author Thi Tuong Vy Nguyen <thi.nguyen.22@lehre.mosbach.dhbw.de>
 */

$host = 'db';

// Database use name
$user = 'MYSQL_USER';

//database user password
$pass = 'MYSQL_PASSWORD';

$database = 'MYSQL_DATABASE';

// check the MySQL connection status
$mysql= new mysqli($host, $user, $pass, $database);
if ($mysql->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// } else {
//     echo "Connected to MySQL server successfully!";
// }
?>