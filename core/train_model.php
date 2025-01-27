<?php

require_once("query.php");
require_once("model.php");

// Mengambil dataset
$dataset = listDataSet();
if (count($dataset) != 0) {
    // Memisahkan dataset berdasarkan label
    $diabetesData = array_filter($dataset, fn($row) => $row["Diabetes"] == 1);
    $nonDiabetesData = array_filter($dataset, fn($row) => $row["Diabetes"] == 0);

    // Menghitung statistik untuk setiap kelas
    $diabetesStats = calculateStats($dataset, 1);
    $nonDiabetesStats = calculateStats($dataset, 0);

    $sampleDiabetes = count($diabetesData);
    $sampleNonDiabetes = count($nonDiabetesData);
    $jumlahData = count($dataset);
    // Update model
    updateModel([
        "diabetes" => [
            "jumlah_sample" => $sampleDiabetes,
            "jumlah_data" => $jumlahData,
            "model_probatilitas" => $sampleDiabetes / $jumlahData,
            "model_statistik" => $diabetesStats
        ],
        "non-diabetes" => [
            "jumlah_sample" => $sampleNonDiabetes,
            "jumlah_data" => $jumlahData,
            "model_probatilitas" => $sampleNonDiabetes / $jumlahData,
            "model_statistik" => $nonDiabetesStats
        ],
    ]);
}

if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'http://') !== false) {
    echo "<script>alert('MODEL BERHASIL DIPERBARUI')</script>";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
