<?php
$zipFile = 'index.zip'; // Ganti dengan nama file ZIP Anda
$extractTo = './'; // Direktori tujuan ekstraksi

if (!file_exists($zipFile)) {
    die("File ZIP tidak ditemukan!");
}

$zip = new ZipArchive;
if ($zip->open($zipFile) === TRUE) {
    $zip->extractTo($extractTo);
    $zip->close();
    echo "Ekstraksi berhasil!";
} else {
    echo "Gagal mengekstrak file ZIP.";
}
?>
