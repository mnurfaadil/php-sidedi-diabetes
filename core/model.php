<?php

// Fungsi untuk menghitung probabilitas Naive Bayes
function calculateProbability($value, $mean, $stdDev) {
    $exponent = exp(-pow($value - $mean, 2) / (2 * pow($stdDev, 2)));
    return (1 / (sqrt(2 * pi()) * $stdDev)) * $exponent;
}

// Fungsi untuk menghitung mean dan standar deviasi untuk setiap fitur
function calculateStats($data, $label) {
    $stats = [];
    $countData = count($data);
    foreach ($data[0] as $feature => $value) {
        if ($feature !== "Diabetes" && $feature !== "ID" && $feature !== "created_at") {
            $filtered = array_filter($data, fn($row) => $row["Diabetes"] == $label);
            $values = array_column($filtered, $feature);
            $zeroValues = array_filter($values, fn($row) => $row == 0);
            $mean = array_sum($values) / count($values);
            $variance = array_sum(array_map(fn($x) => pow($x - $mean, 2), $values)) / count($values);
            $stdDev = sqrt($variance);
            $countFiltered = count($filtered);
            $countZero = count($zeroValues);
            $countValues = $countFiltered - $countZero;
            $meanPx = $countValues / $countFiltered;
            $meanPxNeg = $countZero / $countFiltered;
            $stats[$feature] = [
                "mean" => $mean,
                "px" => $countValues / $countData,
                "meanPxPositive" => $meanPx,
                "meanPxNegative" => $meanPxNeg,
                "stdDev" => $stdDev,
                "countData" => $countData,
                'countFiltered' => $countFiltered,
                'countZero' => $countZero,
                'countValues' => $countValues
            ];
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
        $results[$label] = calculateClassProbabilities($stats[$label], $input, $classProb) * 1000; // membuat desimal lebih mudah dibaca
    }
    arsort($results);
    return [
        $results,
        key($results)
    ];
}

