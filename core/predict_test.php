<?php
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
        "Expect" => "diabetes"
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
        "Expect" => "diabetes"
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
        "Expect" => "non-diabetes"
    ]
];

require("predict.php");

foreach ($inputs as $key => $input) {
    // Melakukan prediksi
    [$result, $prediction] = predictData($input);
    echo "Input   : " . json_encode($input) . PHP_EOL;
    echo "Prediksi: " . ucfirst($prediction) . PHP_EOL;
    echo "Hasil   : " . json_encode($result) . PHP_EOL;
    echo "Status  : " . ($prediction == $input["Expect"] ? "PASS" : "FAILED") . PHP_EOL . PHP_EOL;
}
