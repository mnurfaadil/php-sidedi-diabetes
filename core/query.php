<?php

function listDataSet() {
    require("database.php");
    $sql = "SELECT * FROM diabetes_dataset";
    $result = mysqli_query($conn, $sql);
    $data = array();
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        foreach ($row as $key => $value) {
            if (is_numeric($value)) {
                $row[$key] = (float) $value;
            }
        }
        $data[] = $row;
    }
    mysqli_free_result($result);
    mysqli_close($conn);
    return $data;
}

function updateModel($data) {
    require("database.php");
    $sql = "TRUNCATE diabetes_model;";
    mysqli_query($conn, $sql);

    // Update model untuk kelas diabetes
    $diabetes_prob = $data['diabetes']['model_probatilitas'];
    $diabetes_stats = json_encode($data['diabetes']['model_statistik']);
    $diabetes_sample = $data['diabetes']['jumlah_sample'];
    $diabetes_data = $data['diabetes']['jumlah_data'];
    
    $sql = "INSERT INTO diabetes_model (kelas, model_probabilitas, model_statistik, jumlah_sample, jumlah_data) 
            VALUES ('diabetes', '$diabetes_prob', '$diabetes_stats', '$diabetes_sample', '$diabetes_data')";
            
    mysqli_query($conn, $sql);

    // Update model untuk kelas non-diabetes 
    $nondiabetes_prob = $data['non-diabetes']['model_probatilitas'];
    $nondiabetes_stats = json_encode($data['non-diabetes']['model_statistik']);
    $nondiabetes_sample = $data['non-diabetes']['jumlah_sample'];
    $nondiabetes_data = $data['non-diabetes']['jumlah_data'];
    
    $sql = "INSERT INTO diabetes_model (kelas, model_probabilitas, model_statistik, jumlah_sample, jumlah_data)
            VALUES ('non-diabetes', '$nondiabetes_prob', '$nondiabetes_stats', '$nondiabetes_sample', '$nondiabetes_data')";
            
    mysqli_query($conn, $sql);
    mysqli_close($conn);
}

function listModel() {
    require("database.php");
    $sql = "SELECT * FROM diabetes_model";
    $result = mysqli_query($conn, $sql);
    $classProbs = array();
    $stats = array();
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $keyword = "";
        foreach ($row as $key => $value) {
            $keyword = $row["kelas"];
            if (is_numeric($value)) {
                $row[$key] = (strpos($value, '.') !== false) ? (float)$value : (int)$value;
            }
        }
        // Probabilitas awal untuk setiap kelas
        $classProbs[$keyword] = $row["model_probabilitas"];
        // Statistik model
        $stats[$keyword] = json_decode($row["model_statistik"], true);
    }
    mysqli_free_result($result);
    mysqli_close($conn);

    return [$classProbs, $stats];
}

function clearModel() {    
    require("database.php");

    $sql = "TRUNCATE diabetes_model";
    $r =    mysqli_query($conn, $sql);
    
    $sql = "TRUNCATE diabetes_dataset";
    mysqli_query($conn, $sql);

    mysqli_close($conn);
}
