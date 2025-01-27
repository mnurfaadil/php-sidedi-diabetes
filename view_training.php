<?php
include 'koneksi.php';

if (isset($_POST['hapus'])) {
    // echo 'hapus';
    $id = $_POST['id'];
    $SQL_hapus = "delete from diabetes_dataset where id = $id";
    $res = mysqli_query($koneksi, $SQL_hapus);
    if ($res > 0) {
        echo "<script>alert('data berhasil dihapus')</script>";
    } else {
        echo "<script>alert('data gagal dihapus')</script>";
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <title>Data Training</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>

</head>

<body style="background-color: grey;">
    <!-- Image and text -->
    <?php include 'nav.php'; ?>

    <div class="container" style="background-color: white; padding-top: 2%;padding-bottom: 2%;">
        <div class="ml-5 mr-5 ">
            <h1>Data Training</h1>
            <hr>
            <div class="table-responsive">
                <table class="table table-sm table-striped table-hover" id="table-gejala" style="white-space: nowrap;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th>Polidipsia</th>
                            <th>Poliuria</th>
                            <th>Penurunan Berat Badan</th>
                            <th>Lelah</th>
                            <th>Luka Sulit Sembuh</th>
                            <th>Usia >= 45</th>
                            <th>Riwayat Keluarga</th>
                            <th>Obesitas</th>
                            <th>Sedentari</th>
                            <th>Pola Makan Tidak Sehat</th>
                            <th>Gula Darah Puasa >= 126</th>
                            <th>Gula Darah Sewaktu >= 200</th>
                            <th>HbA1c</th>
                            <th>Diabetes</th>
                            <th>Waktu Import</th>
                            <th style="word-wrap: break-word;width:10%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $SQL = "select * from diabetes_dataset";

                        $rs = mysqli_query($koneksi, $SQL);
                        while ($row = mysqli_fetch_array($rs)) {
                            $id = $row['ID'];
                            $polidipsia = $row['Polidipsia'];
                            $poliuria = $row['Poliuria'];
                            $penurunan_berat_badan = $row['Penurunan_Berat_Badan'];
                            $lelah = $row['Lelah'];
                            $Luka_Sulit_Sembuh = $row['Luka_Sulit_Sembuh'];
                            $usia = $row['Usia'];
                            $riwayat_keluarga = $row['Riwayat_Keluarga'];
                            $obesitas = $row['Obesitas'];
                            $sedentari = $row['Sedentari'];
                            $pola_makan_tidak_sehat = $row['Pola_Makan_Tidak_Sehat'];
                            $gula_darah_puasa = $row['Gula_Darah_Puasa'];
                            $gula_darah_sewaktu = $row['Gula_Darah_Sewaktu'];
                            $hba1c = $row['HbA1c'];
                            $diabetes = $row['Diabetes'];
                            $created_at = $row['created_at'];


                            echo "
                        <tr>
                        <td>$id</td>
                        <td>$polidipsia</td>
                        <td>$poliuria</td>
                        <td>$penurunan_berat_badan</td>
                        <td>$lelah</td>
                        <td>$Luka_Sulit_Sembuh</td>
                        <td>$usia</td>
                        <td>$riwayat_keluarga</td>
                        <td>$obesitas</td>
                        <td>$sedentari</td>
                        <td>$pola_makan_tidak_sehat</td>
                        <td>$gula_darah_puasa</td>
                        <td>$gula_darah_sewaktu</td>
                        <td>$hba1c</td>
                        <td>$diabetes</td>
                        <td>$created_at</td>
                        <td><form method=\"POST\"><input type=\"hidden\" name=\"id\" value=\"$id\">
                            <button type=\"submit\" name=\"hapus\" class=\"btn btn-outline-danger btn-sm\">Hapus</button>
                            </form>
                        </td>
                        </tr>
                        ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>




    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
        </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->

    <script>

        $(document).ready(function () {


            $('#table-gejala').DataTable({
                "order": [
                    [0, "asc"]
                ],
                "lengthMenu": [10, 50, 75, 100, 150, 200]

            });
        });
    </script>
</body>

</html>