<?php
// Einstellungen für CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Verbindung zur Datenbank herstellen
require_once('dbconnect.php');

// Option-Anfrage beantworten und beenden, wenn nötig
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit();
}

// Daten aus dem Vue.js-Frontend abrufen
$data = json_decode(file_get_contents("php://input"));

// ID des zu löschenden Eintrags
$fileId = $data->fileId;

// SQL-Abfrage zum Löschen des Eintrags aus der Datenbank
$sql = "DELETE FROM files WHERE id = $fileId";

if ($mysql->query($sql) === TRUE) {
    // Erfolgreich aus der Datenbank gelöscht

    // Überprüfe, ob die physische Datei auf dem Server vorhanden ist und lösche sie
    $filePath = 'uploads/' . $fileId; // Passe den Pfad entsprechend an
    if (file_exists($filePath)) {
        unlink($filePath);
    }

    echo json_encode(["message" => "Datei wurde gelöscht"], JSON_PRETTY_PRINT);
} else {
    // Fehler beim Löschen in der Datenbank
    echo json_encode(["error" => "Fehler beim Löschen der Datei in der Datenbank"], JSON_PRETTY_PRINT);
}
?>