<?php 
include 'koneksi.php';

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
    <title>NAIVE BAYES</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js">
    </script>

</head>

<body style="background-color: grey;">
    <!-- Image and text -->
    <?php $dataDetail = []; ?>
    <?php include 'nav.php'; ?>


    <div class="container" style="background-color: white; padding-top: 2%;padding-bottom: 2%;">
        <div class="ml-5 mr-5 ">
            <h1>Formula</h1>
            <div class="text-center">
                <img src="https://mlalgorithm.files.wordpress.com/2016/06/screenshot-19.png?w=700" alt="">
            </div>
            <h1>P(Ci)</h1>
            <hr>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Kelas Prediksi</th>
                        <th>Jumlah</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 

                    $SQL = "select * from diabetes_model";

                    $rs = mysqli_query($koneksi,$SQL);
                    while($row = mysqli_fetch_array($rs)){
                        
                        $dataDetail[$row['kelas']] = json_decode($row['model_statistik'], true);
                        
                        $kelas = $row['kelas'];
                        $a = $row['jumlah_sample'];
                        $b = $row['jumlah_data'];
                        $val = $row['model_probabilitas'];

                        echo "
                        <tr>
                        <td>$kelas</td>
                        <td>$a / $b</td>
                        <td>$val</td>
                        </tr>
                        ";
                    }
                    ?>
                </tbody>
            </table>

            <h1>P(X)</h1>
            <hr>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Kelas</th>
                        <th>Atribut</th>
                        <th>Jumlah</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 

                    foreach ($dataDetail as $kelas => $data) {
                        foreach ($data as $atribut => $value) {
                                    
                                $a = $value['countValues'];
                                $b = $value['countData'];
                                $val = $value['px'];

                                echo "
                                <tr>
                                <td>$kelas</td>
                                <td>$atribut</td>
                                <td>$a / $b</td>
                                <td>$val</td>
                                </tr>
                                ";
                        }
                    }
                    ?>
                </tbody>
            </table>

            <h1>P(X | Ci)</h1>
            <hr>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Kelas</th>
                        <th>Atribut</th>
                        <th>Kelas Prediksi</th>
                        <th>Jumlah</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 

                    foreach ($dataDetail as $kelas => $data) {
                        foreach ($data as $atribut => $value) {
                                    
                                $a = $value['countValues'];
                                $a1 = $value['countZero'];
                                $b = $value['countFiltered'];
                                $val = $value['meanPxPositive'];
                                $valNeg = $value['meanPxNegative'];

                                echo "
                                <tr>
                                    <td>$kelas</td>
                                    <td>$atribut</td>
                                    <td>Ya</td>
                                    <td>$a / $b</td>
                                    <td>$val</td>
                                </tr>
                                <tr>
                                    <td>$kelas</td>
                                    <td>$atribut</td>
                                    <td>Tidak</td>
                                    <td>$a1 / $b</td>
                                    <td>$valNeg</td>
                                </tr>
                                ";
                        }
                    }
                    ?>
                </tbody>
            </table>
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
                "lengthMenu": [5, 10, 25, 50, 75, 100, 150, 200]
            });
        });
    </script>
</body>

</html>