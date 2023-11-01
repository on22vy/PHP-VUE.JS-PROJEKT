<?php
// openfile.php

// Datei aus der Datenbank abrufen
if (isset($_GET['file_id'])) {
  $fileId = $_GET['file_id']; // Eindeutige Kennung für die Datei

  // Hier sollten Sie eine Datenbankabfrage durchführen, um den Dateipfad basierend auf $fileId zu erhalten
  // Führen Sie die Abfrage aus und erhalten Sie den Dateipfad

  if ($result) {
    $file = $result->fetch_assoc();
    if ($file) {
      $filePath = $file['file_path'];
      
      // Öffnen der Datei im Browser
      header('Content-type: application/pdf'); // Anpassen des Content-Type je nach Dateityp
      header('Content-Disposition: inline; filename="' . basename($filePath) . '"');
      readfile($filePath);
      exit;
    }
  }
}
?>