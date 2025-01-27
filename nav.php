

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiDeDi Diabetes</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="icon.png" alt="" style="width: 20%;" class="d-inline-block align-top">
                SiDeDi
            </a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/view_training.php">Data Training</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/view_naive_bayes.php">Naive Bayes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/view_deteksi.php">Deteksi</a>
                </li>
            </ul>
            <div>
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="bersihkanData()">
                    Bersihkan Data
                </button>
                <button type="button" class="btn btn-outline-info btn-sm" onclick="latihData()">
                    Latih Data
                </button>
                <button type="button" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Import Data
                </button>
            </div>
        </div>
    </nav>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Data Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="import_data.php" method="POST" enctype="multipart/form-data" >
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Download Template Excel</label>
                            <div>
                                <a href="file/import-template.xlsx" class="btn btn-success btn-sm" download>
                                    Download Template
                                </a>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Import file Excel</label>
                            <input class="form-control" type="file" id="formFile" required  name="form_excel">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" name="import_file">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<script>
    function latihData() {
        if (confirm("Latih data model?")) {
            window.location.href = '/core/train_model.php';
        }
    }
    function bersihkanData() {
        if (confirm("Bersihkan data? Semua data akan hilang!")) {
            if (confirm("Apakah anda benar-benar yakin untuk membersihkan data?")) {
                window.location.href = '/core/clear_model.php';
            }
        }
    }
</script>

</html>