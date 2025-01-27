<?php

// Fungsi untuk membaca dataset dari file CSV
function readDataset($filePath) {
    $data = [];
    if (($handle = fopen($filePath, "r")) !== false) {
        $header = fgetcsv($handle); // Membaca header
        while (($row = fgetcsv($handle)) !== false) {
            $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }
    return $data;
}

// Fungsi untuk menghitung probabilitas Naive Bayes
function calculateProbability($value, $mean, $stdDev) {
    $exponent = exp(-pow($value - $mean, 2) / (2 * pow($stdDev, 2)));
    return (1 / (sqrt(2 * pi()) * $stdDev)) * $exponent;
}

// Fungsi untuk menghitung mean dan standar deviasi untuk setiap fitur
function calculateStats($data, $label) {
    $stats = [];
    foreach ($data[0] as $feature => $value) {
        if ($feature !== "Diabetes" && $feature !== "ID") {
            $filtered = array_filter($data, fn($row) => $row["Diabetes"] == $label);
            $values = array_column($filtered, $feature);
            $mean = array_sum($values) / count($values);
            $variance = array_sum(array_map(fn($x) => pow($x - $mean, 2), $values)) / count($values);
            $stdDev = sqrt($variance);
            $stats[$feature] = ["mean" => $mean, "stdDev" => $stdDev];
        }
    }
    return $stats;
}

// Fungsi untuk menghitung probabilitas kelas
function calculateClassProbabilities($stats, $input, $classProb) {
    $probabilities = $classProb;
    foreach ($stats as $feature => $params) {
        if (isset($input[$feature])) {
            $probabilities *= calculateProbability($input[$feature], $params["mean"], $params["stdDev"]);
        }
    }
    return $probabilities;
}

// Fungsi utama untuk prediksi
function predict($stats, $input, $classProbs) {
    $results = [];
    foreach ($classProbs as $label => $classProb) {
        $results[$label] = calculateClassProbabilities($stats[$label], $input, $classProb);
    }
    arsort($results);
    echo json_encode($results) . PHP_EOL;
    return key($results);
}

// Membaca dataset
$datasetPath = "diabetes_dataset.csv";
$dataset = readDataset($datasetPath);

// Mengkonversi nilai menjadi numerik
foreach ($dataset as &$row) {
    foreach ($row as $key => &$value) {
        if (is_numeric($value)) {
            $value = (float)$value;
        }
    }
}
unset($row, $value);

// Memisahkan dataset berdasarkan label
$diabetesData = array_filter($dataset, fn($row) => $row["Diabetes"] == 1);
$nonDiabetesData = array_filter($dataset, fn($row) => $row["Diabetes"] == 0);

// Menghitung statistik untuk setiap kelas
$diabetesStats = calculateStats($dataset, 1);
$nonDiabetesStats = calculateStats($dataset, 0);

// Probabilitas awal untuk setiap kelas
$classProbs = [
    1 => count($diabetesData) / count($dataset),
    0 => count($nonDiabetesData) / count($dataset),
];

// Statistik model
$stats = [
    1 => $diabetesStats,
    0 => $nonDiabetesStats,
];

// Contoh input untuk prediksi
$inputs = [
    // Test case 1 - Risiko tinggi diabetes
    [
        "Polidipsia" => 1,
        "Poliuria" => 1, 
        "Penurunan_Berat_Badan" => 1,
        "Lelah" => 1,
        "Luka_Sulit_Sembuh" => 1,
        "Usia" => 55,
        "Riwayat_Keluarga" => 1,
        "Obesitas" => 1,
        "Sedentari" => 1,
        "Pola_Makan_Tidak_Sehat" => 1,
        "Gula_Darah_Puasa" => 170,
        "Gula_Darah_Sewaktu" => 280,
        "HbA1c" => 8.5,
    ],
    
    // Test case 2 - Risiko sedang diabetes
    [
        "Polidipsia" => 1,
        "Poliuria" => 0,
        "Penurunan_Berat_Badan" => 1,
        "Lelah" => 1,
        "Luka_Sulit_Sembuh" => 0,
        "Usia" => 45,
        "Riwayat_Keluarga" => 1,
        "Obesitas" => 0,
        "Sedentari" => 1,
        "Pola_Makan_Tidak_Sehat" => 1,
        "Gula_Darah_Puasa" => 130,
        "Gula_Darah_Sewaktu" => 210,
        "HbA1c" => 7.0,
    ],
    
    // Test case 3 - Risiko rendah diabetes
    [
        "Polidipsia" => 0,
        "Poliuria" => 0,
        "Penurunan_Berat_Badan" => 0,
        "Lelah" => 0,
        "Luka_Sulit_Sembuh" => 0,
        "Usia" => 25,
        "Riwayat_Keluarga" => 0,
        "Obesitas" => 0,
        "Sedentari" => 0,
        "Pola_Makan_Tidak_Sehat" => 0,
        "Gula_Darah_Puasa" => 90,
        "Gula_Darah_Sewaktu" => 140,
        "HbA1c" => 5.0,
    ]
];

echo "MODEL DATASET   : " . json_encode([
    "stats" => $stats,
    "classProbs" => $classProbs,
]) . PHP_EOL;

foreach ($inputs as $key => $input) {
    // Melakukan prediksi
    $prediction = predict($stats, $input, $classProbs);
    echo "Input   : " . json_encode($input) . PHP_EOL;
    echo "Prediksi: " . ($prediction == 1 ? "Diabetes" : "Tidak Diabetes") . PHP_EOL;
}

?>
