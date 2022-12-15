<?php
// periksa apakah user sudah login, cek kehadiran session name
// jika tidak ada, redirect ke login.php
session_start();
if (!isset($_SESSION["nama"])) {
  header("Location: login.php");
}

// buka koneksi dengan MySQL
include("koneksi.php");

// cek apakah form telah di submit
if (isset($_POST["submit"])) {
  // form telah disubmit, cek apakah berasal dari edit_mahasiswa.php
  // atau update data dari form_edit.php

  if ($_POST["submit"] == "Edit") {
    //nilai form berasal dari halaman edit_mahasiswa.php

    // ambil nilai nim
    $nama = htmlentities(strip_tags(trim($_POST["nama"])));
    // filter data
    $nama = mysqli_real_escape_string($conn, $nama);

    // ambil semua data dari database untuk menjadi nilai awal form
    $query = "SELECT * FROM data_user WHERE nama='$nama'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
      die("Query Error: " . mysqli_errno($conn) .
        " - " . mysqli_error($conn));
    }

    // tidak perlu pakai perulangan while, karena hanya ada 1 record
    $data = mysqli_fetch_assoc($result);

    $nama         = $data["nama"];
    $umur = $data["umur"];
    $alamat    = $data["alamat"];
    $no     = $data["no"];
    $email        = $data["email"];
    $kost       = $data["kost"];


    // bebaskan memory
    mysqli_free_result($result);
  } else if ($_POST["submit"] == "Update Data") {
    // nilai form berasal dari halaman form_edit.php
    // ambil semua nilai form
    $nama          = htmlentities(strip_tags(trim($_POST["nama"])));
    $umur         = htmlentities(strip_tags(trim($_POST["umur"])));
    $alamat = htmlentities(strip_tags(trim($_POST["alamat"])));
    $no    = htmlentities(strip_tags(trim($_POST["no"])));
    $email     = htmlentities(strip_tags(trim($_POST["email"])));
    $kost    = htmlentities(strip_tags(trim($_POST["kost"])));
  }

  $pesan_error = "";

  // menggenerate pilihan (option )kos
  $alfakost = "";
  $putri4saudara = "";
  $putrikamboja = "";
  $panamraya = "";
  $alkahfi = "";
  $de_kostpanam = "";
  $ziferpanam = "";
  $kos_pria = "";
  $nasya1 = "";
  $putri_jingga_kampar = "";
  $putri_mandala = "";
  $putra_rizki = "";

  switch ($kost) {
    case "alfa kost":
      $alfakost = "selected";
      break;
    case "Kost putri 4 saudara":
      $putru4saudara = "selected";
      break;
    case "kost putri kamboja":
      $putrikamboja = "selected";
      break;
    case "kost panam raya":
      $panamraya     = "selected";
      break;
    case "kost panam alkahfi":
      $alkahfi     = "selected";
      break;
    case "zifer kost panam":
      $ziferpanam     = "selected";
      break;
    case "kost pria":
      $kos_pria     = "selected";
      break;
    case "kost nasya 1":
      $nasya1     = "selected";
      break;
    case "kost putri jingga kampar":
      $putri_jingga_kampar = "selected";
      break;
    case "kost putri mandala":
      $putri_mandala = "selected";
      break;
    case "kost putra rizki":
      $putra_rizki = "selected";
    case "de'kost panam":
      $de_kostpanam = "selected";
      break;
  }


  // jika tidak ada error, input ke database
  if (($pesan_error === "") and ($_POST["submit"] == "Update Data")) {

    // buka koneksi dengan MySQL
    include("koneksi.php");

    // filter semua data
    $nama         = mysqli_real_escape_string($conn, $nama);
    $umur         = mysqli_real_escape_string($conn, $umur);
    $alamat = mysqli_real_escape_string($conn, $alamat);
    $no     = mysqli_real_escape_string($conn, $no);
    $email     = mysqli_real_escape_string($conn, $email);
    $kost         = mysqli_real_escape_string($conn, $kost);


    // query SQL untuk insert data
$query="UPDATE data_user SET umur='$umur',alamat='$alamat',no='$no',email='$email',kost='$kost' where nama='$nama'";
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
                <form id="form_mahasiswa" action="edit-user.php" method="post">
      <fieldset>
        <legend>EditData User</legend>
        <p>
          <label for="nama">NAMA: </label>
          <input type="text" name="nama" id="nama" value="<?php echo $nama ?>" readonly>
          (tidak bisa diubah di menu edit)
        </p>
        <p>
          <label for="umur">Umur : </label>
          <input type="text" name="umur" id="umur" value="<?php echo $umur ?>">
        </p>
        <p>
          <label for="alamat">Alamat : </label>
          <input type="text" name="alamat" id="alamat" value="<?php echo $alamat ?>">
        <p>
        <label for="kost" class="col-sm-2 col-form-label">Pilih Kost</label>
          <select name="kost" id="kost">
            <option value="alfa kost" <?php echo $alfakost ?>>Alfa Kost</option>
            <option value="kost putri 4 saudara" <?php echo $putri4saudara ?>>Kost Putri 4 Bersaudara</option>
            <option value="kost putri kamboja" <?php echo $putrikamboja ?>>Kost Putri Kamboja</option>
            <option value="kost panam raya" <?php echo $panamraya ?>>Kost Panam Raya</option>
            <option value="kost panam alkahfi Pekanbaru" <?php echo $alkahfi ?>>Kost Panam Alkahfi Pekanbaru</option>
            <option value="zifer Kost panam" <?php echo $ziferpanam ?>>Zifer Kost Panam Raya</option>
            <option value="de'kost panam" <?php echo $de_kostpanam ?>>De'kost Panam</option>
            <option value="kost pria" <?php echo $kos_pria ?>>Kost Pria</option>
            <option value="Kost naysa 1" <?php echo $nasya1 ?>>Kost Nasyah 1</option>
            <option value="putri jingga kampar" <?php echo $putri_jingga_kampar ?>>Kost Putri Jingga Kampar</option>
            <option value="putri mandala" <?php echo $putri_mandala ?>>Kost Putri Mandala</option>
            <option value="putra rizki" <?php echo $putra_rizki ?>>Kost Putra Rizki</option>
          </select>
        </p>
        <p>
          <label for="email">Email: </label>
          <input type="text" name="email" id="email" value="<?php echo $email?>">
        </p>
        <p>
          <label for="no">No Handphone: </label>
          <input type="text" name="no" id="no" value="<?php echo $no?>">
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