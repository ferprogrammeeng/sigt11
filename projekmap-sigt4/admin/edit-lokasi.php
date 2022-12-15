<?php
// periksa apakah user sudah login, cek kehadiran session name
// jika tidak ada, redirect ke login.php
// session_start();
// if (!isset($_SESSION["nama"])) {
//   header("Location: login.php");
// }

// buka koneksi dengan MySQL
include("koneksi.php");

// cek apakah form telah di submit
if (isset($_POST["submit"])) {
    // form telah disubmit, cek apakah berasal dari edit_mahasiswa.php
    // atau update data dari form_edit.php

    if ($_POST["submit"] == "Edit") {
        //nilai form berasal dari halaman edit_mahasiswa.php

        // ambil nilai nim
        $nama = htmlentities(strip_tags(trim($_POST["nama_kost"])));
        // filter data
        $nama = mysqli_real_escape_string($conn, $nama);

        // ambil semua data dari database untuk menjadi nilai awal form
        $query = "SELECT * FROM lokasi WHERE nama_kost='$nama'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query Error: " . mysqli_errno($conn) .
                " - " . mysqli_error($conn));
        }

        // tidak perlu pakai perulangan while, karena hanya ada 1 record
        $data = mysqli_fetch_assoc($result);

        $nama = $data["nama_kost"];
        $harga = $data["harga"];
        $lat   = $data["lat"];
        $lng    = $data["lng"];
        $nama_penyewa  = $data["nama_penyewa"];



        // bebaskan memory
        mysqli_free_result($result);
    } else if ($_POST["submit"] == "Update Data") {
        // nilai form berasal dari halaman form_edit.php
        // ambil semua nilai form
        $nama          = htmlentities(strip_tags(trim($_POST["nama_kost"])));
        $harga        = htmlentities(strip_tags(trim($_POST["harga"])));
        $lat   = htmlentities(strip_tags(trim($_POST["lat"])));
        $lng     = htmlentities(strip_tags(trim($_POST["lng"])));
        $nama_penyewa  = htmlentities(strip_tags(trim($_POST["nama_penyewa"])));
    }

    $pesan_error = "";


    // jika tidak ada error, input ke database
    if (($pesan_error === "") and ($_POST["submit"] == "Update Data")) {

        // buka koneksi dengan MySQL
        include("koneksi.php");

        // filter semua data
        $nama         = mysqli_real_escape_string($conn, $nama);
        $harga        = mysqli_real_escape_string($conn, $harga);
        $lat   = mysqli_real_escape_string($conn, $lat);
        $lng     = mysqli_real_escape_string($conn, $lng);
        $nama_penyewa         = mysqli_real_escape_string($conn, $nama_penyewa);


        // query SQL untuk insert data
        $query = "UPDATE lokasi SET harga='$harga',lat='$lat', lng='$lng', nama_penyewa='$nama_penyewa' where nama_kost='$nama'";
        $result = mysqli_query($conn, $query);

        //periksa hasil query
        if ($result) {
            // INSERT berhasil, redirect ke tampil_mahasiswa.php + pesan
            $pesan = "Mahasiswa dengan nama = \"<b>$nama</b>\" sudah berhasil di update";
            $pesan = urlencode($pesan);
            header("Location: index.php?pesan={$pesan}");
        } else {
            die("Query gagal dijalankan: " . mysqli_errno($conn) .
                " - " . mysqli_error($conn));
        }
    }
} else {
    // form diakses secara langsung!
    // redirect ke edit_mahasiswa.php
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UTS PSIBWL</title>
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
            <h4 class="mb-5 text-white">Daftar List</h4>

            <li>
                <a class="text-white" href="index.php">
                    <span class="	glyphicon glyphicon-home"></span>
                    Home
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
                    <form id="form_mahasiswa" action="edit-lokasi.php" method="post">
                        <fieldset>
                            <legend>Ubah Data Lokasi</legend>
                            <p>
                                <label for="nama_kost">NAMA KOST: </label>
                                <input type="text" name="nama_kost" id="nama_kost" value="<?php echo $nama ?>" readonly>
                                (tidak bisa diubah di menu edit)
                            </p>
                            <p>
                                <label for="umur">Harga: </label>
                                <input type="text" name="harga" id="harga" value="<?php echo $harga ?>">
                            </p>
                            <p>
                                <label for="lat">Lat : </label>
                                <input type="text" name="lat" id="lat" value="<?php echo $lng ?>">

                            <p>
                                <label for="lng">Lng: </label>
                                <input type="text" name="lng" id="lng" value="<?php echo $lng ?>">
                            </p>
                            <p>
                                <label for="nama_penyewa">Nama Penyewa: </label>
                                <input type="text" name="nama_penyewa" id="nama_penyewa" value="<?php echo $nama_penyewa ?>">
                            </p>

                        </fieldset>
                        <br>
                        <p>
                            <input type="submit" name="submit" value="Update Data">
                        </p>
                    </form>
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