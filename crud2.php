<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Data Siswa</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Varela Round', sans-serif;
            font-size: 13px;
        }

        .table-responsive {
            margin: 30px 0;
        }

        .table-wrapper {
            background: #fff;
            padding: 20px 25px;
            border-radius: 3px;
            min-width: 1000px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

        .table-title {
            padding-bottom: 15px;
            background: #435d7d;
            color: #fff;
            padding: 16px 30px;
            min-width: 100%;
            margin: -20px -25px 10px;
            border-radius: 3px 3px 0 0;
        }

        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
        }

        .table-title .btn-group {
            float: right;
        }

        .table-title .btn {
            color: #fff;
            float: right;
            font-size: 13px;
            border: none;
            min-width: 50px;
            border-radius: 2px;
            border: none;
            outline: none !important;
            margin-left: 10px;
        }

        .table-title .btn i {
            float: left;
            font-size: 21px;
            margin-right: 5px;
        }

        .table-title .btn span {
            float: left;
            margin-top: 2px;
        }

        table.table tr th,
        table.table tr td {
            border-color: #e9e9e9;
            padding: 12px 15px;
            vertical-align: middle;
        }

        table.table tr th:first-child {
            width: 60px;
        }

        table.table tr th:last-child {
            width: 100px;
        }

        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }

        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }
        table.table td:last-child i {
            opacity: 0.9;
            font-size: 22px;
            margin: 0 5px;
        }

        table.table td a {
            font-weight: bold;
            color: #566787;
            display: inline-block;
            text-decoration: none;
            outline: none !important;
        }

        table.table td a:hover {
            color: #2196F3;
        }

        table.table td a.edit {
            color: #FFC107;
        }

        table.table td a.delete {
            color: #F44336;
        }

        table.table td i {
            font-size: 19px;
        }
    </style>
</head>

<body>
<?php
    $host       = "localhost";
    $user       = "root";
    $pass       = "020202putri";
    $db         = "tugas5pemweb";

    $koneksi    = mysqli_connect($host, $user, $pass, $db);
    if (!$koneksi) {
        die("Tidak dapat terkoneksi");
    }else{
        echo "Terhubung";
    }

    $Nama_Lengkap   = "";
    $Tempat_Lahir   = "";
    $Tanggal_Lahir  = "";
    $Usia           = "";
    $Alamat         = "";
    $berhasil       = "";
    $error          = "";

    $operasi = "";

    if (isset($_GET['operasi'])) {
        $operasi = $_GET['operasi'];
    }
    if ($operasi == 'delete') {
        $id         = $_GET['id'];
        $sql1       = "delete from siswa where id = '$id'";
        $query1         = mysqli_query($koneksi, $sql1);
        if ($query1) {
            $berhasil = "Berhasil hapus data";
        } else {
            $error  = "Gagal melakukan delete data";
        }
    }
    if ($operasi == 'edit') {
        $id             = $_GET['id'];
        $sql1           = "select * from data_siswa where id = '$id'";
        $query1         = mysqli_query($koneksi, $sql1);
        $r1             = mysqli_fetch_array($query1);
        $Nama_Lengkap   = $r1['Nama_Lengkap'];
        $Tempat_Lahir   = $r1['Tempat_Lahir'];
        $Tanggal_Lahir   = $r1['Tanggal_Lahir'];
        $Usia    = $r1['Usia'];
        $Alamat    = $r1['Alamat'];
    }
    if (isset($_POST['simpan'])) { //untuk create
        $Nama_Lengkap   = $_POST['Nama_Lengkap'];
        $Tempat_Lahir   = $_POST['Tempat_Lahir'];
        $Tanggal_Lahir  = $_POST['Tanggal_Lahir'];
        $Usia           = $_POST['Usia'];
        $Alamat         = $_POST['Alamat'];
        if ($Nama_Lengkap && $Tempat_Lahir && $Tanggal_Lahir && $Usia && $Alamat) {
            if ($operasi == 'edit') { //untuk update
                $sql1       = "update siswa set Nama_Lengkap = '$Nama_Lengkap', Tempat_Lahir =' $Tempat_Lahir', Tanggal_Lahir = '$Tanggal_Lahir', Usia='$Usia', Alamat = '$Alamat' where id = '$id'";
                $query1         = mysqli_query($koneksi, $sql1);
                if ($query1) {
                    $berhasil = "Data berhasil diupdate";
                } else {
                    $error  = "Data gagal diupdate";
                }
            } else { //untuk insert
                $sql1   = "insert into data_siswa (Nama_Lengkap,Tempat_Lahir,Tanggal_Lahir,Usia,Alamat) values ('$Nama_Lengkap','$Tempat_Lahir','$Tanggal_Lahir','$Usia','$Alamat')";
                $query1     = mysqli_query($koneksi, $sql1);
                if ($query1) {
                    $berhasil    = "Berhasil memasukkan data baru";
                } else {
                    $error      = "Gagal memasukkan data";
                }
            }
        } else {
            $error = "Silakan masukkan semua data";
        }
    }
    ?>
    <div class="mx-auto container mt-5">
        
    <div class="table-wrapper">
    <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Tambah Data</h2>
                        </div>
                    </div>
                </div>
        <form action="" method="POST">

            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="Nama_Lengkap" name="Nama_Lengkap" value="<?php echo $Nama_Lengkap ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="Tempat_Lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="Tempat_Lahir" name="Tempat_Lahir" value="<?php echo $Tempat_Lahir ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="Tanggal_Lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="Tanggal_Lahir" name="Tanggal_Lahir" value="<?php echo $Tanggal_Lahir ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="Usia" class="col-sm-2 col-form-label">Usia</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="Usia" name="Usia" value="<?php echo $Usia ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="Alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="Alamat" name="Alamat" value="<?php echo $Alamat ?>">
                </div>
            </div>
            <div class="col-12 text-center">
                <input type="submit" name="simpan" value="Simpan" class="btn btn-info text-black" />
            </div>
        </form>
    </div>
    </div>
    
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Data Siswa</h2>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Tempat Lahir</th>
                            <th scope="col">Tanggal Lahir</th>
                            <th scope="col">Usia</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "select * from data_siswa order by id desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id             = $r2['id'];
                            $Nama_Lengkap   = $r2['Nama_Lengkap'];
                            $Tempat_Lahir   = $r2['Tempat_Lahir'];
                            $Tanggal_Lahir  = $r2['Tanggal_Lahir'];
                            $Usia           = $r2['Usia'];
                            $Alamat         = $r2['Alamat'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $id ?></th>
                                <td scope="row"><?php echo $Nama_Lengkap ?></td>
                                <td scope="row"><?php echo $Tempat_Lahir ?></td>
                                <td scope="row"><?php echo $Tanggal_Lahir ?></td>
                                <td scope="row"><?php echo $Usia ?></td>
                                <td scope="row"><?php echo $Alamat ?></td>
                                <td scope="row" class="btn-group-justified">

                                    <a href="crud2.php?operasi=edit&id=<?php echo $id ?>" class="edit"><i class="material-icons">&#xE254;</i></a>
                                    <a href="crud2.php?operasi=delete&id=<?php echo $id ?>" class="delete"><i class="material-icons">&#xE872;</i></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>