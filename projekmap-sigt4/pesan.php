<?php
  // periksa apakah user sudah login, cek kehadiran session name 
  // jika tidak ada, redirect ke login.php
  session_start();
  if (!isset($_SESSION["nama"])) {
     header("Location: login-user.php");
  }
  include("assets/database/koneksi.php");
  if(isset($_POST["pesan"])){
    // ambil nilai form
    $nama = $_POST["nama"];
    $umur = $_POST["umur"];
    $alamat = $_POST["alamat"];
    $hp = $_POST["no"];
    $email = $_POST["email"];
    $kost = $_POST["kost"];

    $pesan_error="";
    
    // menggenerate pilihan (option )kos
    $alfakost="";
    $putri4saudara="";
    $putrikamboja="";
    $panamraya="";
    $alkahfi="";
    $de_kostpanam="";
    $ziferpanam="";
    $kost_pria="";
    $nasya1="";
    $putri_jingga_kampar="";
    $putri_mandala="";
    $putra_rizki="";

    switch($kost) {
     case "alfa kost" : $alfakost = "selected";  break;
     case "Kost putri 4 saudara" : $putru4saudara = "selected"; break;
     case "kost putri kamboja"   : $putrikamboja= "selected";  break;
     case "kost panam raya": $panamraya     = "selected";  break;
     case "kost panam alkahfi"   : $alkahfi     = "selected";  break;
     case "zifer kost panam"   : $ziferpanam     = "selected";  break;
     case "kost pria"   : $kost_pria     = "selected";  break;
     case "kost nasya 1"   : $nasya1     = "selected";  break;
     case "kost putri jingga kampar":$putri_jingga_kampar ="selected";
    break;
     case "kost putri mandala":$putri_mandala ="selected";
    break;
     case "kost putra rizki":$putra_rizki ="selected";
     case "de'kost panam":$de_kostpanam ="selected";
    break;
    }

    $query = "INSERT INTO data_user VALUES (
        '','$nama','$alamat','$hp','$email','$umur','$kost');
        ";
    $result = mysqli_query($conn, $query);
    if($result){
        echo "<script>
        alert('pemesanan berhasil, silahkan cek transaksi anda');
        document.location.href='transaksi.php';
        </script>";
    }else {
        echo "<script>alert('pemesanan gagal')</script>";
    }
  }else {
    $nama = "";
    $umur = "";
    $alamat = "";
    $hp = "";
    $email = "";
    $kost = "";
    $alfakost="";
    $putri4saudara="";
    $putrikamboja="";
    $panamraya="";
    $alkahfi="";
    $de_kostpanam="";
    $ziferpanam="";
    $kost_pria="";
    $nasya1="";
    $putri_jingga_kampar="";
    $putri_mandala="";
    $putra_rizki="";
  }
 
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>
        body {
            background-color: deepskyblue;
        }

        .card {
            width: 1000px;
            line-height: auto;
            margin: 0 auto;
            margin-top: 100px;
            box-shadow: 1px 0px 10px, -1px 0px 10px;
        }
    </style>
</head>

<body>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <div class="container px-4">
            <a class="navbar-brand" href="#page-top">CARI KOST PANAM ID</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Back</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="card">
        <h5 class="card-header bg-light" style="text-align:center">Cari Kost Wilayah PANAM</h5>
        <div class="card-body">
            <h5 class="card-title">Selamat Datang!...</h5>
            <p class="card-text">Silahkan Pesan Kost impian anda...</p>
            <form action="pesan.php" method="post">
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama"class="form-control" id="nama" value="<?php echo $nama ?>"placeholder="budi...">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="umur" class="col-sm-2 col-form-label">Umur</label>
                    <div class="col-sm-10">
                        <input type="text"  name="umur"class="form-control" id="umur" value="<?php echo $umur?>" placeholder="106 tahun">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="alamat"  value="<?php echo $alamat?>" name="alamat" placeholder="Jakarta">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="no" class="col-sm-2 col-form-label">No Handphone</label>
                    <div class="col-sm-10">
                        <input type="text" name="no" class="form-control" id="no" value="<?php echo $hp?>"placeholder="0823820840240">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email"  name="email" class="form-control" id="email" value="<?php echo $email ?>"placeholder="email@gmail.com">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kost" class="col-sm-2 col-form-label">Pilih Kost</label>
                    <div class="col-sm-10">
                        <select name="kost" id="kost">
                            <option value="pilih" >Pilih</option>
                            <option value="alfa kost" <?php echo $alfakost ?>>Alfa Kost</option>
                            <option value="kost putri 4 saudara" <?php echo $putri4saudara ?>>Kost Putri 4 Bersaudara</option>
                            <option value="kost putri kamboja"<?php echo $putrikamboja ?>>Kost Putri Kamboja</option>
                            <option value="kost panam raya"<?php echo $panamraya ?>>Kost Panam Raya</option>
                            <option value="kost panam alkahfi Pekanbaru" <?php echo $alkahfi ?>>Kost Panam Alkahfi Pekanbaru</option>
                            <option value="zifer Kost panam" <?php echo $ziferpanam?>>Zifer Kost Panam Raya</option>
                            <option value="de'kost panam" <?php echo $de_kostpanam?>>De'kost Panam</option>
                            <option value="kost pria" <?php echo $kost_pria ?>>Kost Pria</option>
                            <option value="Kost naysa 1" <?php echo $nasya1 ?>>Kost Nasyah 1</option>
                            <option value="putri jingga kampar" <?php echo $putri_jingga_kampar ?>>Kost Putri Jingga Kampar</option>
                            <option value="putri mandala" <?php echo $putri_mandala ?>>Kost Putri Mandala</option>
                            <option value="putra rizki" <?php echo $putra_rizki ?>>Kost Putra Rizki</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" name="pesan">Pesan</button>
                <button type="submit" class="btn btn-primary" name="pesan">Lihat Transaksi</button>
            </form>

        </div>
    </div>
</body>

</html>