<?php

$file_path = "uploads/" . $_FILES['file']['name'];

// Überprüfe den Dateityp der Datei
$file_type = mime_content_type($file_path);

if (strpos($file_type, "application/pdf") === 0) {
    // Wenn die Datei ein PDF ist, zeige sie im Browser an
    header('Content-Type: application/pdf');
    readfile($file_path);
} else {
    echo "Dies ist keine PDF-Datei.";
}
?>