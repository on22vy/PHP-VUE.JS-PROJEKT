<?php
$uploadDirectory = "uploads/"; // Pfad zum Upload-Ordner auf Ihrem Server
$fileList = [];

if ($handle = opendir($uploadDirectory)) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
            $fileList[] = $file;
        }
    }
    closedir($handle);
}

header('Content-Type: application/json');
echo json_encode($fileList);
?>