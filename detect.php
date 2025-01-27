<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validasi input
    $errors = [];
    
    // Validasi semua input boolean (0/1)
    $boolean_fields = [
        'banyak_kencing', 'turun_bb', 'luka_sukar', 
        'lemas', 'keturunan',
        'polidipsia', 'obesitas', 'sedentari', 'pola_makan',
        'gula_puasa', 'gula_sewaktu', 'hba1c', 'usia'
    ];
    
    foreach ($boolean_fields as $field) {
        if (!isset($_POST[$field]) || !in_array($_POST[$field], ['0', '1'])) {
            $errors[] = ucfirst(str_replace('_', ' ', $field)) . " tidak valid";
        }
        ${$field} = filter_var($_POST[$field], FILTER_VALIDATE_INT);
    }

    // Jika ada error, hentikan proses
    if (!empty($errors)) {
        echo json_encode(['status' => 'error', 'messages' => $errors]);
        exit;
    }

    $usia = $_POST['usia'];
    $Polidipsia = $_POST['polidipsia'];
    $banyak_kencing = $_POST['banyak_kencing'];
    $turun_bb = $_POST['turun_bb'];
    $luka_sukar = $_POST['luka_sukar'];
    $lemas = $_POST['lemas'];
    $keturunan = $_POST['keturunan'];
    $obesitas = $_POST['obesitas'];
    $sedentari = $_POST['sedentari'];
    $pola_makan = $_POST['pola_makan'];
    $gula_puasa = $_POST['gula_puasa'];
    $gula_sewaktu = $_POST['gula_sewaktu'];
    $hba1c = $_POST['hba1c'];

    // Input yang sudah divalidasi
    $input = [
        "Polidipsia" => $Polidipsia,
        "Poliuria" => $banyak_kencing,
        "Penurunan_Berat_Badan" => $turun_bb,
        "Lelah" => $lemas,
        "Luka_Sulit_Sembuh" => $luka_sukar,
        "Usia" => $usia,
        "Riwayat_Keluarga" => $keturunan,
        "Obesitas" => $obesitas,
        "Sedentari" => $sedentari,
        "Pola_Makan_Tidak_Sehat" => $pola_makan,
        "Gula_Darah_Puasa" => $gula_puasa,
        "Gula_Darah_Sewaktu" => $gula_sewaktu,
        "HbA1c" => $hba1c
    ];


    require("core/predict.php");

    [$prediction, $vonis] = predictData($input);

    // Store all inputs and prediction in session
    session_start();
    foreach ($_POST as $key => $value) {
        $_SESSION[$key] = $value;
    }
    $_SESSION['prediction'] = $prediction;
    $_SESSION['prediction']['hasil'] = $vonis == "diabetes" ? "Positif" : "Negatif";

    header("Location: view_deteksi.php");
    exit();
}