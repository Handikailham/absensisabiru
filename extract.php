<?php
$zip = new ZipArchive;
$file = 'app.zip'; // Ganti dengan nama file ZIP kamu

if ($zip->open($file) === TRUE) {
    $zip->extractTo('./'); // Ekstrak ke folder saat ini
    $zip->close();
    echo 'Extracted successfully!';
} else {
    echo 'Failed to extract!';
}
?>
