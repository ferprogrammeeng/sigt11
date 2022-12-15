<?php
session_start();
if (!isset($_SESSION["nama"])) {
  header("Location: login.php");
}
include("koneksi.php");
$sql = "SELECT * FROM lokasi ";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
    <!-- bootstrap 5 css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
    <!-- custom css -->
    <!-- <link rel="stylesheet" href="style.css" /> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <style>
        li {
            list-style: none;
            margin: 20px 0 20px 0;
        }

        a {
            text-decoration: none;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            margin-left: -300px;
            transition: 0.4s;
        }

        .active-main-content {
            margin-left: 250px;
        }

        .active-sidebar {
            margin-left: 0;
        }

        #main-content {
            transition: 0.4s;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 8px 0;
        }

        .table th,
        .table td {
            border: 0px solid;
            padding: 10px;
        }

        .table th {
            background-color: #0d6efd;
            color: white;
        }

        tr:nth-child(odd) {
            background-color: Lavender;
        }

        .table td:first-child {
            width: 50px;
            text-align: center;
        }

        .table td:last-child {
            width: 150px;
            text-align: center;
        }

        #pengajuan {
            height: auto;
            margin-bottom: 20px;
        }

        #peminjaman {
            height: auto;
            margin-bottom: 20px;
        }

        #riwayat {
            height: auto;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div>
        <div class="sidebar p-4 bg-primary" id="sidebar">
            <h4 class="mb-5 text-white"><span class="glyphicon glyphicon-user"></span> Admin</h4>
            <li>
                <a class="text-white" href="#data_lokasi">
                    <span class="glyphicon glyphicon-zoom-in"></span>
                    Data Lokasi
                </a>
            </li>
            <li>
                <a class="text-white" href="#data_user">
                    <span class="glyphicon glyphicon-user"></span>
                    Data User
                </a>
            </li>
            <li>
                <a class="text-white" href="ubah_lokasi.php">
                    <span class="glyphicon glyphicon-check"></span>
                    Ubah Data Lokasi
                </a>
            </li>
            <li>
                <a class="text-white" href="ubah_user.php">
                    <span class="glyphicon glyphicon-check"></span>
                    Ubah Data User
                </a>
            </li>
            <li>
                <a class="text-white" href="hapus_lokasii.php">
                    <span class="glyphicon glyphicon-folder-close"></span>
                    Hapus Data Lokasi
                </a>
            </li>
            <li>
                <a class="text-white" href="hapus_user.php">
                    <span class="glyphicon glyphicon-folder-close"></span>
                    Hapus Data User
                </a>
            </li>
            <li>
                <a class="text-white" href="logout.php">
                    <span class="glyphicon glyphicon-log-out"></span>
                    Logout
                </a>
            </li>

           
        </div>
    </div>
    <div class="p-4" id="main-content">
        <button class="btn btn-primary" id="button-toggle">
            <i class="bi bi-list"></i>
        </button>
        <div class="card mt-5 " style="background-color:whitesmoke">
            <div id="data_lokasi">
                <div class="card-body">
                    <h4>Data Lokasi</h4>
                    <table border="0" class="table">
                        <thead>
                            <th>No</th>
                            <th>Nama Kost</th>
                            <th>Harga</th>
                            <th>Nama Penyewa</th>
                            <th>lat</th>
                            <th>lng</th>
                        </thead>
                        <tbody>
                            <?php
                            include("koneksi.php");
                            $sql = "SELECT * FROM lokasi ";
                            $result = mysqli_query($conn, $sql);
                            $no = 1;
                            ?>
                            <?php foreach ($result as $a) : ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $a["nama_kost"]; ?></td>
                                    <td><?= $a["harga"]; ?></td>
                                    <td><?= $a["nama_penyewa"]; ?></td>
                                    <td><?= $a["lat"]; ?></td>
                                    <td><?= $a["lng"]; ?></td>
                                </tr>
                                <?php $no++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mt-5 " style="background-color:whitesmoke">
            <div id="data_user">
                <div class="card-body">
                    <h4>Data User</h4>
                    <table border="0" class="table">
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Umur</th>
                            <th>No HP</th>
                            <th>Email</th>
                            <th>Nama Kost</th>
                        </thead>
                        <tbody>
                            <?php
                            include("koneksi.php");
                            $sql = "SELECT * FROM data_user ";
                            $result = mysqli_query($conn, $sql);
                            $no = 1;
                            ?>
                            <?php foreach ($result as $a) : ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $a["nama"]; ?></td>
                                    <td><?= $a["alamat"]; ?></td>
                                    <td><?= $a["umur"]; ?></td>
                                    <td><?= $a["no"]; ?></td>
                                    <td><?= $a["email"]; ?></td>
                                    <td><?= $a["kost"]; ?></td>
                                </tr>
                                <?php $no++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      

    </div>

    <script>
        // event will be executed when the toggle-button is clicked
        document.getElementById("button-toggle").addEventListener("click", () => {

            // when the button-toggle is clicked, it will add/remove the active-sidebar class
            document.getElementById("sidebar").classList.toggle("active-sidebar");

            // when the button-toggle is clicked, it will add/remove the active-main-content class
            document.getElementById("main-content").classList.toggle("active-main-content");
        });
    </script>
</body>

</html>