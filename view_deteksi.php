<?php
include 'koneksi.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reset'])) {
    session_unset();
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
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
    <title>Test Deteksi</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js">
    </script>
    <style>
        td,
        th {
            border: 1px solid gray;
            padding: 10px;
        }
    </style>

</head>

<body style="background-color: grey;">
    <!-- Image and text -->
    <?php include 'nav.php'; ?>
    <div class="container" style="background-color: white; padding-top: 2%;padding-bottom: 2%;">
        <div class="ml-5 mr-5 ">
            <div class="row">
                <div class="col-sm-6">
                    <form method="POST" action="detect.php">
                        <h1 class="text-center">Test Deteksi Diabetes</h1>
                        <?php $no = 1; ?>
                        <table style="width: 100%;">
                            <tr>
                                <td><?= $no++ ?>.</td>
                                <td>Usia ≥ 45</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="usia" id="usia1" value="1"
                                            required <?php if (isset($_SESSION['usia']) && $_SESSION['usia'] == '1')
                                                echo 'checked'; ?>>
                                        <label class="form-check-label" for="usia1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="usia" id="usia2" value="0"
                                            required <?php if (isset($_SESSION['usia']) && $_SESSION['usia'] == '0')
                                                echo 'checked'; ?>>
                                        <label class="form-check-label" for="usia2">Tidak</label>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td><?= $no++ ?>.</td>
                                <td>Banyak kencing (Poliuria)?</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="banyak_kencing" id="bk1"
                                            value="1" required <?php if (isset($_SESSION['banyak_kencing']) && $_SESSION['banyak_kencing'] == '1')
                                                echo 'checked'; ?>>
                                        <label class="form-check-label" for="bk1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="banyak_kencing" id="bk2"
                                            value="0" required <?php if (isset($_SESSION['banyak_kencing']) && $_SESSION['banyak_kencing'] == '0')
                                                echo 'checked'; ?>>
                                        <label class="form-check-label" for="bk2">Tidak</label>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td><?= $no++ ?>.</td>
                                <td>Banyak minum (Polidipsia)?</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="polidipsia" id="pd1"
                                            value="1" required <?php if (isset($_SESSION['polidipsia']) && $_SESSION['polidipsia'] == '1')
                                                echo 'checked'; ?>>
                                        <label class="form-check-label" for="pd1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="polidipsia" id="pd2"
                                            value="0" required <?php if (isset($_SESSION['polidipsia']) && $_SESSION['polidipsia'] == '0')
                                                echo 'checked'; ?>>
                                        <label class="form-check-label" for="pd2">Tidak</label>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td><?= $no++ ?>.</td>
                                <td>Penurunan Berat Badan?</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="turun_bb" id="bb1" value="1"
                                            required <?php if (isset($_SESSION['turun_bb']) && $_SESSION['turun_bb'] == '1')
                                                echo 'checked'; ?>>
                                        <label class="form-check-label" for="bb1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="turun_bb" id="bb2" value="0"
                                            required <?php if (isset($_SESSION['turun_bb']) && $_SESSION['turun_bb'] == '0')
                                                echo 'checked'; ?>>
                                        <label class="form-check-label" for="bb2">Tidak</label>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td><?= $no++ ?>.</td>
                                <td>Luka Sukar sembuh?</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="luka_sukar" id="ls1"
                                            value="1" required <?php if (isset($_SESSION['luka_sukar']) && $_SESSION['luka_sukar'] == '1')
                                                echo 'checked'; ?>>
                                        <label class="form-check-label" for="ls1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="luka_sukar" id="ls2"
                                            value="0" required <?php if (isset($_SESSION['luka_sukar']) && $_SESSION['luka_sukar'] == '0')
                                                echo 'checked'; ?>>
                                        <label class="form-check-label" for="ls2">Tidak</label>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td><?= $no++ ?>.</td>
                                <td>Sering merasa letih/lemas?</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="lemas" id="lms1" value="1"
                                            required <?php if (isset($_SESSION['lemas']) && $_SESSION['lemas'] == '1')
                                                echo 'checked'; ?>>
                                        <label class="form-check-label" for="lms1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="lemas" id="lms2" value="0"
                                            required <?php if (isset($_SESSION['lemas']) && $_SESSION['lemas'] == '0')
                                                echo 'checked'; ?>>
                                        <label class="form-check-label" for="lms2">Tidak</label>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td><?= $no++ ?>.</td>
                                <td>Memiliki riwayat keturunan diabetes dalam keluarga?</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="keturunan" id="kt1" value="1"
                                            required <?php if (isset($_SESSION['keturunan']) && $_SESSION['keturunan'] == '1')
                                                echo 'checked'; ?>>
                                        <label class="form-check-label" for="kt1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="keturunan" id="kt2" value="0"
                                            required <?php if (isset($_SESSION['keturunan']) && $_SESSION['keturunan'] == '0')
                                                echo 'checked'; ?>>
                                        <label class="form-check-label" for="kt2">Tidak</label>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td><?= $no++ ?>.</td>
                                <td>Obesitas?</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="obesitas" id="ob1" value="1"
                                            required <?php if (isset($_SESSION['obesitas']) && $_SESSION['obesitas'] == '1')
                                                echo 'checked'; ?>>
                                        <label class="form-check-label" for="ob1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="obesitas" id="ob2" value="0"
                                            required <?php if (isset($_SESSION['obesitas']) && $_SESSION['obesitas'] == '0')
                                                echo 'checked'; ?>>
                                        <label class="form-check-label" for="ob2">Tidak</label>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td><?= $no++ ?>.</td>
                                <td>Sedentari (Kurang aktivitas fisik)?</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sedentari" id="sd1" value="1"
                                            required <?php if (isset($_SESSION['sedentari']) && $_SESSION['sedentari'] == '1')
                                                echo 'checked'; ?>>
                                        <label class="form-check-label" for="sd1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sedentari" id="sd2" value="0"
                                            required <?php if (isset($_SESSION['sedentari']) && $_SESSION['sedentari'] == '0')
                                                echo 'checked'; ?>>
                                        <label class="form-check-label" for="sd2">Tidak</label>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td><?= $no++ ?>.</td>
                                <td>Pola Makan Tidak Sehat?</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="pola_makan" id="pm1"
                                            value="1" required <?php if (isset($_SESSION['pola_makan']) && $_SESSION['pola_makan'] == '1')
                                                echo 'checked'; ?>>
                                        <label class="form-check-label" for="pm1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="pola_makan" id="pm2"
                                            value="0" required <?php if (isset($_SESSION['pola_makan']) && $_SESSION['pola_makan'] == '0')
                                                echo 'checked'; ?>>
                                        <label class="form-check-label" for="pm2">Tidak</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><?= $no++ ?>.</td>
                                <td>Gula Darah Puasa ≥ 126 mg/dL</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gula_puasa" id="gp1"
                                            value="1" required <?php if (isset($_SESSION['gula_puasa']) && $_SESSION['gula_puasa'] == '1')
                                                echo 'checked'; ?>>
                                        <label class="form-check-label" for="gp1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gula_puasa" id="gp2"
                                            value="0" required <?php if (isset($_SESSION['gula_puasa']) && $_SESSION['gula_puasa'] == '0')
                                                echo 'checked'; ?>>
                                        <label class="form-check-label" for="gp2">Tidak</label>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td><?= $no++ ?>.</td>
                                <td>Gula Darah Sewaktu ≥ 200 mg/dL</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gula_sewaktu" id="gs1"
                                            value="1" required <?php if (isset($_SESSION['gula_sewaktu']) && $_SESSION['gula_sewaktu'] == '1')
                                                echo 'checked'; ?>>
                                        <label class="form-check-label" for="gs1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gula_sewaktu" id="gs2"
                                            value="0" required <?php if (isset($_SESSION['gula_sewaktu']) && $_SESSION['gula_sewaktu'] == '0')
                                                echo 'checked'; ?>>
                                        <label class="form-check-label" for="gs2">Tidak</label>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td><?= $no++ ?>.</td>
                                <td>HbA1c ≥ 6.5%</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="hba1c" id="h1" value="1"
                                            required <?php if (isset($_SESSION['hba1c']) && $_SESSION['hba1c'] == '1')
                                                echo 'checked'; ?>>
                                        <label class="form-check-label" for="h1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="hba1c" id="h2" value="0"
                                            required <?php if (isset($_SESSION['hba1c']) && $_SESSION['hba1c'] == '0')
                                                echo 'checked'; ?>>
                                        <label class="form-check-label" for="h2">Tidak</label>
                                    </div>
                                </td>
                            </tr>

                            <tr class="text-center">
                                <td colspan="2"><button type="submit" class="btn btn-warning btn-block"
                                        name="test">Deteksi</button></td>
                            </tr>
                        </table>

                    </form>
                </div>
                <div class="col-sm-6">
                    <h1 class="text-center">Hasil Deteksi Diabetes</h1>
                    <table style="width: 100%;">
                        <tr>
                            <td>Terdeteksi Ya</td>
                            <td><?php if (isset($_SESSION['prediction'])) {
                                echo round($_SESSION['prediction']['diabetes'], 4);
                            } else {
                                echo '-';
                            } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Terdeteksi Tidak</td>
                            <td><?php if (isset($_SESSION['prediction'])) {
                                echo round($_SESSION['prediction']['non-diabetes'], 4);
                            } else {
                                echo '-';
                            } ?>
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td colspan="2">Hasil Deteksi : </td>
                        </tr>
                        <tr class="text-center" style="background-color: yellow;">
                            <td colspan="2">
                                <b><?php if (isset($_SESSION['prediction'])) {
                                    echo $_SESSION['prediction']['hasil'];
                                } else {
                                    echo '-';
                                } ?></b>
                            </td>
                        </tr>
                        <?php if (isset($_SESSION['prediction'])) {
                            echo '<tr>
                                    <td colspan="2">
                                        <form method="POST">
                                            <button type="submit" class="btn btn-warning btn-block w-100"
                                            name="reset">Periksa Kembali</button>
                                        </form>
                                    </td>
                                </tr>';
                        }?>
                        
                    </table>
                </div>
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

</body>

</html>