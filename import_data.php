<?php


require "./vendor/autoload.php";
include "./koneksi.php";

if (isset($_POST['import_file'])) {

    $input_name = 'form_excel';
    $file_import = $_FILES[$input_name]['name'];
    $ekstensi = explode(".", $file_import);
    $nama_file = "file-import" . '.' . end($ekstensi);
    $sumber = $_FILES[$input_name]['tmp_name'];
    $target_dir = "./file/";
    $target_file = $target_dir . $nama_file;
    $upload = move_uploaded_file($sumber, $target_file);

    if ($xlsx = SimpleXLSX::parse($target_file)) {

        $header_values = $rows = [];
        foreach ($xlsx->rows() as $k => $r) {
            if ($k === 0) {
                $header_values = $r;
                continue;
            }
            $rows[] = array_combine($header_values, $r);
        }
        $created_at = date('Y-m-d H:i:s');
        // print_r($rows);
        $sql = "insert into diabetes_dataset (Polidipsia,Poliuria,Penurunan_Berat_Badan,Lelah,Luka_Sulit_Sembuh,Usia,Riwayat_Keluarga,Obesitas,Sedentari,Pola_Makan_Tidak_Sehat,Gula_Darah_Puasa,Gula_Darah_Sewaktu,HbA1c,Diabetes,created_at) values ";
        for ($i=0; $i < count($rows) ; $i++) { 
            $polidipsia = $rows[$i]['Polidipsia'];
            $poliuria = $rows[$i]['Poliuria']; 
            $penurunan_bb = $rows[$i]['Penurunan_Berat_Badan'];
            $lelah = $rows[$i]['Lelah'];
            $luka_sulit = $rows[$i]['Luka_Sulit_Sembuh'];
            $usia = $rows[$i]['Usia'];
            $riwayat = $rows[$i]['Riwayat_Keluarga'];
            $obesitas = $rows[$i]['Obesitas'];
            $sedentari = $rows[$i]['Sedentari'];
            $pola_makan = $rows[$i]['Pola_Makan_Tidak_Sehat'];
            $gula_puasa = $rows[$i]['Gula_Darah_Puasa'];
            $gula_sewaktu = $rows[$i]['Gula_Darah_Sewaktu'];
            $hba1c = $rows[$i]['HbA1c'];
            $diabetes = $rows[$i]['Diabetes'];
            
            $sql .= "('$polidipsia','$poliuria','$penurunan_bb','$lelah','$luka_sulit','$usia','$riwayat','$obesitas','$sedentari','$pola_makan','$gula_puasa','$gula_sewaktu','$hba1c','$diabetes','$created_at'),";
        }
        $sql = substr($sql, 0, -1); // menghilangkan koma diakhir
        $sql .= ';';

        $insert = mysqli_query($koneksi,$sql);
        $_SESSION['jumlah_insert'] = count($rows);
        header('Location: core/train_model.php');
        // echo $sql;

        // or $xlsx->toHTML();	
    } else {
        echo SimpleXLSX::parseError();
    }
}
