<?php
//These are the defined authentication environment in the db service

// The MySQL service named in the docker-compose.yml.
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