<?php

require_once("query.php");

// Membersihkan data
clearModel();

if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'http://') !== false) {
    echo "<script>alert('MODEL BERHASIL DIPERBARUI')</script>";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
