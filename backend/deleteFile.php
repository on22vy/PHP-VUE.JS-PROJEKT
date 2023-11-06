<?php
// Einstellungen für CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// connect with database
require_once('dbconnect.php');

// Answer option request and exit if necessary
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit();
}

// get data from vue.js frontend
$data = json_decode(file_get_contents("php://input"));

// id of the item which should be delete
$fileId = $data->fileId;

// SQL query to delete the entry from the database
$sql = "DELETE FROM files WHERE id = $fileId";

if ($mysql->query($sql) === TRUE) {
    // Successfully deleted from the database

    // Path to the file in the upload directory
    $uploadDirectory = 'uploads/'; 
    $filePath = $uploadDirectory . $fileId;

    if (file_exists($filePath)) {
        // Delete file in upload directory
        unlink($filePath);
    }

    echo json_encode(["message" => "Datei wurde gelöscht"], JSON_PRETTY_PRINT);
} else {
    // Error deleting in the database
    echo json_encode(["error" => "Fehler beim Löschen der Datei in der Datenbank"], JSON_PRETTY_PRINT);
}
?>