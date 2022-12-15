<?php
// periksa apakah user sudah login, cek kehadiran session name 
// jika tidak ada, redirect ke login.php
session_start();
if (!isset($_SESSION["nama"])) {
  header("Location: login-user.php");
}
include("assets/database/koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>PROJEK UAS SIGT</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/style-peta.css">
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />

  <!-- Core theme CSS (includes Bootstrap)-->
  <!-- <link href="assets/css/styles.css" rel="stylesheet" /> -->

  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

  <!-- Core theme JS-->
  <!-- <script src="js/scripts.js"></script> -->
</head>

<body id="page-top">

  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container px-4">
      <a class="navbar-brand" href="#page-top">CARI KOST PANAM ID</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item" style="padding:10px"><a class="nav-link" href="#peta"><span class="glyphicon glyphicon-zoom-out"></span> Lokasi Kost</a></li>
          <li class="nav-item" style="padding:10px"><a class="nav-link" href="#info"><span class="glyphicon glyphicon-home"></span> Info Kost</a></li>
          <li class="nav-item" style="padding:10px"><a class="nav-link" href="#pesan"><span class="glyphicon glyphicon-random"></span> Boking Kost</a></li>
          <li class="nav-item" style="padding:10px"><a class="nav-link" href="admin/login.php"><span class="glyphicon glyphicon-user"></span> admin</a></li>
          <li class="nav-item" style="padding:10px"><a class="nav-link" href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Header-->
  <header class="bg-primary bg-gradient text-white">
    <div class="container px-4 text-center">
      <h1 class="fw-bolder">Selamat Datang!</h1>
      <p class="lead">Aplikasi Pencarian Kost di Wilayah Panam</p>
      <a class="btn btn-lg btn-light" href="#peta">Start scrolling!</a>
    </div>
  </header>

  <!-- About section-->
  <section id="peta">
    <div class="container px-4">
      <div class="card">

        <div class="card-header bg-dark">
          <h3 class="text-center text-light">Lokasi Kost Wilayah Panam</h3>
        </div>
        <div class="card-body" id="googleMap" style="height: 380px"></div>

        <div class="fs-3">
          <h3 class="text-center bg-warning pb-2 pt-1">Buat rute</h3>
          <div class="d-flex justify-content-center w-100">
            <div class="mx-2">
              <label>Asal:</label>
              <input id="start" type="text" />
            </div>
            <div class="mx-2">
              <label>Tujuan:</label>
              <input id="end" type="text" />
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Services section-->
  <section class="bg-light" id="info">
    <div class="container px-4">
      <div class="card">
        <div class="card-header bg-dark">
          <h3 class="text-center text-light">Informasi Kost Wilayah Panam</h3>
        </div>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col" class="bg-primary">No</th>
              <th scope="col" class="bg-primary">Nama Kost</th>
              <th scope="col" class="bg-primary">Harga</th>
              <th scope="col" class="bg-primary">Nama Penyewa</th>
              <th scope="col" class="bg-primary">Lihat Peta</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php
              $no = 1;
              $cari = mysqli_query($conn, "SELECT * FROM lokasi");
              $rows = [];
              while ($row = mysqli_fetch_array($cari)) {
                $rows[] = $row;
              }

              foreach ($rows as $data) {
                echo "
                  <tr id='row-$no'>
                    <td>$no</td>
                    <td data-name='$data[nama_kost]'>$data[nama_kost]</td>
                    <td>$data[harga]</td>
                    <td>$data[nama_penyewa]</td>
                    <td>
                      <a id='a-$no' href='#peta'
                        class='view_map'
                        data-lat='$data[lat]'
                        data-lng='$data[lng]'
                      >Lihat Map</a>
                    </td>
                  </tr>
                  ";
                $no++;
              }
              ?>
          </tbody>
        </table>
      </div>
    </div>
    </div>
  </section>

  <!-- Contact section-->
  <section id="pesan">
    <div class="container px-4">
      <div class="card" id="card-body">
        <div class="card-header bg-dark">
          <h3 class="text-center text-light">Daftar Kost</h3>
        </div>
        <br><br>

        <div class="row row-cols-3">
        <!--?php foreach($kosts as $kost): ?>
          <div class="col" id="coll">
            <div class="card bg-light" id="card-body">
              <div class="card-body">
                <div class="image">
                  <img src="assets/img/<!?= $kost['gambar'] ?>" alt="" class="img">
                </div>
                <br>
                <h5 class="card-title"><!?= $kost['nama'] ?></h5>
                <p class="card-text"><!?= $kost['alamat'] ?></p>
                <b>
                  <p class="card-text">Rp.<!?= $kost['harga'] ?>/ <span>bulan</span></p>
                </b>
                <br>
                <a href="pesan.php" class="btn btn-primary">Pesan Sekarang</a>
              </div>
            </div>
          </div>
        <!?php endforeach ?-->
        </div>

        <div class="row">
          <div class="col-sm-4" id="coll">
            <div class="card bg-light" id="card-body">
              <div class="card-body">
                <div class="image">
                  <img src="assets/img/gbr1.jpg" alt="" class="img">
                </div>
                <br>
                <h5 class="card-title">Alfa Kost</h5>
                <p class="card-text">Gg. Putri, Simpang Baru, Kec. Tampan, Kota Pekanbaru, Riau 28293</p>
                <b>
                  <p class="card-text">Rp.500.000/ <span>bulan</span></p>
                </b>
                <br>
                <a href="pesan.php" class="btn btn-primary">Pesan Sekarang</a>
              </div>
            </div>
          </div>

          <div class="col-sm-4" id="coll">
            <div class="card bg-light" id="card-body">
              <div class="card-body">
                <div class="image">
                  <img src="assets/img/gbr2.jpg" alt="" class="img">
                </div>
                <h5 class="card-title">Kost Putri 4 Bersaudara Panam</h5>
                <p class="card-text">Jalan Mawar, Gg. Putri Panam No.2, Simpang Baru, Kec. Tampan, Kota Pekanbaru, Riau 28293</p>
                <b>
                  <p class="card-text">Rp.650.000/ <span>bulan</span></p>
                </b>
                <br>
                <a href="pesan.php" class="btn btn-primary">Pesan Sekarang</a>
              </div>
            </div>
          </div>

          <div class="col-sm-4" id="coll">
            <div class="card bg-light" id="card-body">
              <div class="card-body">
                <div class="image">
                  <img src="assets/img/gbr3.jpg" alt="" class="img">
                </div>
                <br>
                <h5 class="card-title">Kost Putri Kamboja</h5>
                <p class="card-text">Jl. Kamboja Jl. Bangau Sakti, Simpang Baru, Kec. Tampan, Kota Pekanbaru, Riau 28293</p>
                <b>
                  <p class="card-text">Rp.400.000/ <span>bulan</span></p>
                </b>
                <br>
                <a href="pesan.php" class="btn btn-primary">Pesan Sekarang</a>
              </div>
            </div>
          </div>

          <div class="col-sm-4" id="coll">
            <div class="card bg-light" id="card-body">
              <div class="card-body ">
                <div class="image">
                  <img src="assets/img/gbr4.jpg" alt="" class="img">
                </div>
                <br>
                <h5 class="card-title">Kost Panam Alkahfi</h5>
                <p class="card-text">JL Mukhsinin no 24 B, Panam, Tuah Karya, Kec. Tampan, Kota Pekanbaru, Riau 28293</p>
                <b>
                  <p class="card-text">Rp.500.000/ <span>bulan</span></p>
                </b>
                <br>
                <a href="pesan.php" class="btn btn-primary">Pesan Sekarang</a>
              </div>
            </div>
          </div>

          <div class="col-sm-4" id="coll">
            <div class="card bg-light" id="card-body">
              <div class="card-body">
                <div class="image">
                  <img src="assets/img/gbr5.jpg" alt="" class="img">
                </div>
                <br>
                <h5 class="card-title">Zifer Kost Panam</h5>
                <p class="card-text">Jl. HR. Soebrantas No.11, Delima, Kec. Tampan, Kota Pekanbaru, Riau 28293 </p>
                <b>
                  <p class="card-text">Rp.800.000/ <span>bulan</span></p>
                </b>
                <br>
                <a href="pesan.php" class="btn btn-primary">Pesan Sekarang</a>
              </div>
            </div>
          </div>

          <div class="col-sm-4" id="coll">
            <div class="card bg-light" id="card-body">
              <div class="card-body">
                <div class="image">
                  <img src="assets/img/gbr6.jpg" alt="" class="img">
                </div>
                <br>
                <h5 class="card-title">Kost Nasya 1</h5>
                <p class="card-text">jl. Tuah karya, Perumahan Royal Permata Hijau Blok 8P, Panam, Tuah Karya, Kec. Tampan, Kota Pekanbaru, Riau 28299</p>
                <b>
                  <p class="card-text">Rp.500.000/ <span>bulan</span></p>
                </b>
                <a href="pesan.php" class="btn btn-primary">Pesan Sekarang</a>
              </div>
            </div>
          </div>

          <div class="col-sm-4" id="coll">
            <div class="card bg-light" id="card-body">
              <div class="card-body">
                <div class="image">
                  <img src="assets/img/gbr8.jpg" alt="" class="img">
                </div>
                <br>
                <h5 class="card-title">Kost Putri Jingga Kampar</h5>
                <p class="card-text">Jl. Buluh Cina panam, Tuah Karya, Kec. Tampan, Kota Pekanbaru, Riau 28293</p>
                <b>
                  <p class="card-text">Rp.500.000/ <span>bulan</span></p>
                </b>
                <a href="pesan.php" class="btn btn-primary">Pesan Sekarang</a>
              </div>
            </div>
          </div>

          <div class="col-sm-4" id="coll">
            <div class="card bg-light" id="card-body">
              <div class="card-body">
                <div class="image">
                  <img src="assets/img/gbr7.jpg" alt="" class="img">
                </div>
                <br>
                <h5 class="card-title">Kost Putri Mandala</h5>
                <p class="card-text">Jl. Tuah Karya, Tuah Karya, Kec. Tampan, Kota Pekanbaru, Riau 28293</p>
                <b>
                  <p class="card-text">Rp.500.000/ <span>bulan</span></p>
                </b>
                <a href="pesan.php" class="btn btn-primary">Pesan Sekarang</a>
              </div>
            </div>
          </div>

          <div class="col-sm-4" id="coll">
            <div class="card bg-light" id="card-body">
              <div class="card-body">
                <div class="image">
                  <img src="assets/img/gbr10.jpg" alt="" class="img">
                </div>
                <br>
                <h5 class="card-title">Kost Putra Panam Raya</h5>
                <p class="card-text">Jl. Binakrida UNRI No.Kelurahan, Simpang Baru, Kec. Tampan, Kota Pekanbaru, Riau 28292</p>
                <b>
                  <p class="card-text">Rp.800.000/ <span>bulan</span></p>
                </b>
                <a href="pesan.php" class="btn btn-primary">Pesan Sekarang</a>
              </div>
            </div>
          </div>
          <div class="col-sm-4" id="coll">
            <div class="card bg-light" id="card-body">
              <div class="card-body">
                <div class="image">
                  <img src="assets/img/gbr11.jpg" alt="" class="img">
                </div>
                <br>
                <h5 class="card-title">Kost Pria</h5>
                <p class="card-text">F95G+C65, Tuah Karya, Tampan, Pekanbaru City, Riau 28293</p>
                <b>
                  <p class="card-text">Rp.500.000/ <span>bulan</span></p>
                </b>
                <a href="pesan.php" class="btn btn-primary">Pesan Sekarang</a>
              </div>
            </div>
          </div>

          <div class="col-sm-4" id="coll">
            <div class="card bg-light" id="card-body">
              <div class="card-body">
                <div class="image">
                  <img src="assets/img/gbr12.jpg" alt="" class="img">
                </div>
                <br>
                <h5 class="card-title">De'Kost Panam</h5>
                <p class="card-text">Di belakang Rs. Awal Bros Panam, Jl. HR. Subrantas, perumahan Bumi Rezki Permai (BRP, Tuah Karya, Kec. Tampan, Kota Pekanbaru, Riau 28293</p>
                <b>
                  <p class="card-text">Rp1.000.000/ <span>bulan</span></p>
                </b>
                <a href="pesan.php" class="btn btn-primary">Pesan Sekarang</a>
              </div>
            </div>
          </div>

          <div class="col-sm-4" id="coll">
            <div class="card bg-light" id="card-body">
              <div class="card-body">
                <div class="image">
                  <img src="assets/img/13.jpg" alt="" class="img">
                </div>
                <br>
                <h5 class="card-title">Kos Putra Rizki</h5>
                <p class="card-text">Perumahan Villa Pesona Panam Blok J11, Jalan HR. Soebrantas Panam, Simpang Baru, Tampan, Rimba Panjang, Kec. Tambang, Kota Pekanbaru, Riau 28293</p>
                <p class="card-text"><b>Rp500.000/ <span>bulan</span></b></p>
                <a href="pesan.php" class="btn btn-primary">Pesan Sekarang</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer-->
  <footer class="py-5 bg-dark">
    <div class="container px-4">
      <p class="m-0 text-center text-white">Copyright &copy; Cari Kost Panam ID</p>
    </div>
  </footer>

  <!-- Menyisipkan library Google Maps -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVZxervTdilci_cAg0qjntWtoo3LIZpxI&callback=initMap&v=weekly" defer></script>
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9r6hO2qdOImADWOuBJ3XMNq2bgmPoxS0&callback=initMap&v=weekly" defer></script> -->

  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

  <script>
    const lokasi = [

      <?php
      foreach ($rows as $data) {
        echo "{
      name: '$data[nama_kost]',
      lat: $data[lat],
      lng: $data[lng]
    },";
      }
      ?>

    ];
  </script>

  <script type="text/javascript" src="js/init-map.js"></script>
  <script type="text/javascript" src="js/cari-map.js"></script>

</body>

</html>