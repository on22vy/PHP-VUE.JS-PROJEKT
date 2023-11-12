<?php
/**
 * @author Acelya Cagan <acelya.cagan@gmail.com>
 */

// Einstellungen für CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Include the database connection file
require_once 'dbconnect.php';

// Answer the option query  and exit, if neccessary
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit();
}

// get data from vue.js frontend
$data = json_decode(file_get_contents("php://input"));

// check whether all required data has been passed
if (isset($data->file_id) && isset($data->new_filename)) {
    $fileId = $data->file_id;
    $newFilename = $data->new_filename;

    // SQL statement to update the file name in the database
    $updateQuery = "UPDATE files SET filename = ? WHERE id = ?";

    // Prepare the SQL statement
    $stmt = $mysql->prepare($updateQuery);

    // Check whether the preparation was successful
    if ($stmt === false) {
        die("Vorbereitung des SQL-Statements ist fehlgeschlagen: " . $mysql->error);
    }

    // Bind the parameters and execute the statement
    $stmt->bind_param('si', $newFilename, $fileId);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Dateiname erfolgreich aktualisiert"], JSON_PRETTY_PRINT);
    } else {
        echo json_encode(["error" => "Fehler beim Aktualisieren des Dateinamens: " . $stmt->error], JSON_PRETTY_PRINT);
    }

    // close the statement
    $stmt->close();
} else {
    echo json_encode(["error" => "Ungültige Anfrage. Es wurden nicht alle erforderlichen Daten übergeben."], JSON_PRETTY_PRINT);
}
?>
