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
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Sistem Informasi Mahasiswa</title>
  <style>
    /* ====GLOBAL STYLE==== */
    body {
      background-color: #F8F8F8;
    }

    div.container {
      width: 960px;
      padding: 10px 50px 20px;
      background-color: white;
      margin: 20px auto;
      box-shadow: 1px 0px 10px, -1px 0px 10px;
    }

    h1,
    h2,
    h3 {
      text-align: center;
      font-family: Cambria, "Times New Roman", serif;
      clear: both;
    }

    #footer {
      text-align: right;
      margin-top: 20px;
    }

    /* =====HEADER===== */
    #header {
      height: 60px;
    }

    #logo {
      font-size: 42px;
      float: left;
      text-shadow: 1px 2px #C0C0C0;
      margin-top: 10px;
      margin-bottom: 0px;
    }

    #logo span {
      color: green;
    }

    #tanggal {
      text-align: right;
    }

    hr {
      margin: 0px;
    }

    /* =====NAVIGATION===== */
    nav {
      width: 500px;
      float: left;
      clear: both;
    }

    ul {
      padding: 0;
      margin: 20px 0;
      list-style: none;
      overflow: hidden;
    }

    nav li a {
      float: left;
      background-color: #E3E3E3;
      color: black;
      text-decoration: none;
      font-size: 20px;
      height: 30px;
      line-height: 30px;
      padding: 5px 20px;
    }

    nav li a:hover {
      background-color: #757575;
      color: white;
    }

    /* ======TABLE====== */
    table {
      border-collapse: collapse;
      border-spacing: 0;
      border: 1px black solid;
      width: 100%
    }

    th,
    td {
      padding: 8px 15px;
      border: 1px black solid;
    }

    tr:nth-child(2n+3) {
      background-color: #F2F2F2;
    }

    /* ======PESAN====== */
    .pesan {
      background-color: #C0FFA9;
      padding: 10px 15px;
      margin: 0 0 20px 0;
      border: 1px solid green;
      box-shadow: 1px 0px 3px green;
      text-align: center;
    }

    .error {
      background-color: #FFECEC;
      padding: 10px 15px;
      margin: 0 0 20px 0;
      border: 1px solid red;
      box-shadow: 1px 0px 3px red;
    }

    /* ====SEARCH BOX==== */
    #search {
      font-size: 20px;
      width: 340px;
      float: right;
      margin: 20px 0px;
      background-color: #E3E3E3;
    }

    #search p {
      margin: 0px;
      padding: 8px 20px;
    }

    /* ====FORM==== */
    #form_mahasiswa p {
      margin: 0;
    }

    #form_mahasiswa fieldset {
      padding: 20px;
    }

    #form_mahasiswa input,
    #form_mahasiswa select {
      margin-bottom: 10px;
    }

    #form_mahasiswa label {
      width: 110px;
      float: left;
      margin-right: 10px;
    }

    #form_mahasiswa [readonly] {
      background-color: #F3F3F3;
    }
  </style>
  <link href="style.css" rel="stylesheet">
  <link rel="icon" href="favicon.png" type="image/png">
</head>

<body>
  <div class="container">
    <div id="header">
      <h1 id="logo">Sistem Informasi  <span>Pencarian Kost Panam</span></h1>
      <p id="tanggal"><?php echo date("d M Y"); ?></p>
    </div>
    <hr>
   
    <h2>Edit Data User</h2>
    <?php
    // tampilkan error jika ada
    if ($pesan_error !== "") {
      echo "<div class=\"error\">$pesan_error</div>";
    }
    ?>
    <form id="form_mahasiswa" action="edit-user.php" method="post">
      <fieldset>
        <legend>Edit</legend>
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

</body>

</html>
<?php
// tutup koneksi dengan database mysql
mysqli_close($conn);
?>