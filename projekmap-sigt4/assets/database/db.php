<?php
mysqli_report(MYSQLI_REPORT_STRICT);
try {
    $mysqli = new mysqli("localhost", "root", "");
    // cek koneksi
    if (!$mysqli) {
        throw new Exception($mysqli->error);
    } else {
        echo "koneksi sukses<br>";
    }
    //Buat database
    $query = " CREATE DATABASE IF NOT EXISTS sigt_client6";
    //jalankan query
    $mysqli->query($query);
    if (!$mysqli) {
        throw new Exception($mysqli->error);
    } else {
        echo "db berhasil dibuat <br>.";
    }

    // pilih db yg telah dibuat
    $mysqli->select_db("sigt_client6");
    if (!$mysqli) {
        throw new Exception($mysqli->error);
    } else {
        echo "db berhasil dipilih <br>.";
    }

    
    // hapus tabel jika sudah ada
    $query = " DROP TABLE IF EXISTS lokasi";
    $mysqli->query($query);
    if (!$mysqli) {
        throw new Exception($mysqli->error);
    } else {
        echo "tabel lokasi berhasil dihapus <br>";
    }

    // buat tabel mahasiswa
    $query = " CREATE TABLE lokasi (
            idlokasi INT PRIMARY KEY AUTO_INCREMENT,
            nama_kost VARCHAR(100),
            harga INT,
            lat VARCHAR(100),
            lng VARCHAR(100),
            nama_penyewa VARCHAR(100)   
        )";
    $mysqli->query($query);
    if (!$mysqli) {
        throw new Exception($mysqli->error);
    } else {
        echo "tabel lokasi berhasil dibuat <br>";
    }


    // insert tabel
    $query = " INSERT INTO lokasi (nama_kost,harga,lat,lng,nama_penyewa) VALUES 
                ('Alfa Kost','500000','0.47503928206457596', '101.37257067595861','Gita Sastria'),
                ('Kost Putri 4 Bersaudara','650000','0.4778591953872022', '101.37374725109986','Siti Nur Aisyah'),
                ('Kost Putri Kamboja','40000','0.4817393791441927', '101.37472506639598','Dewi'),
                ('Kost Panam Raya','500000','0.4724688694280787', '101.3846599958255','Agus'),
                ('Kost Panam Alkahfi Pekanbaru','500000','0.47274482234524356', '101.38778684708456','Budi'),
                ('Zifer Kost Panam','800000',' 0.46534159340750775', '101.39828622161292','Sulaiman'),
                ('De,Kost Panam','1000000','0.46336216488889387', ' 101.39086312084535','Neymar'),
                ('Kost Pria','350000',' 0.4594252944398629', '  101.37564520069807','Muhammad Raffi'),
                ('Kost Nisyah 1','500000',' 0.45762290777985504', ' 101.38470033854267','Annisyah'),
                ('Kost Putri Jingga Kampar','500000','0.4692359207731749', ' 101.36302153224024','Putri Indah'),
                ('Kost Putri Mandala','500000',' 0.46142689430991674', '101.36971288025222','Amalia'),
                ('Kost Putra Rizki','500000',' 0.4586156755514466', '101.35314814051115','Opthreo')
            ";
     $mysqli->query($query);
    if (!$mysqli) {
        throw new Exception($mysqli->error);
    } else {
        echo "tabel lokasi berhasil diisi <br>";
    }

    
    // hapus tabel jika sudah ada
    $query = " DROP TABLE IF EXISTS data_user";
    $mysqli->query($query);
    if (!$mysqli) {
        throw new Exception($mysqli->error);
    } else {
        echo "tabel data user berhasil dihapus <br>";
    }

     // buat tabel mahasiswa
     $query = " CREATE TABLE data_user (
        nama VARCHAR(100) PRIMARY KEY AUTO_INCREMENT,
        umur INT,
        email VARCHAR(100),
        alamat VARCHAR(100),
        no VARCHAR(100),
        kost VARCHAR(100)   
    )";
$mysqli->query($query);
if (!$mysqli) {
    throw new Exception($mysqli->error);
} else {
    echo "tabel data user berhasil dibuat <br>";
}
   

  // cek apakah tabel user sudah ada. jika ada, hapus tabel
  $query = "DROP TABLE IF EXISTS user";
  $mysqli->query($query);
  if (!$mysqli) {
      throw new Exception($mysqli->error);
  } else {
      echo "tabel user berhasil dihapus <br>";
  }


  // buat query untuk CREATE tabel user
  $query  = "CREATE TABLE user (username VARCHAR(50), password CHAR(40))";
  $mysqli->query($query);
  if (!$mysqli) {
      throw new Exception($mysqli->error);
  } else {
      echo "tabel user berhasil dibuat <br>";
  }

 // buat username dan password untuk admin
  $username = "user123";
  $password = sha1("user123");

  // buat query untuk INSERT data ke tabel admin
  $query  = "INSERT INTO user VALUES ('$username','$password')";
  $mysqli->query($query);
  if (!$mysqli) {
      throw new Exception($mysqli->error);
  } else {
      echo "tabel user berhasil diisi <br>";
  }

   // cek apakah tabel admin sudah ada. jika ada, hapus tabel
   $query = "DROP TABLE IF EXISTS admin";
   $mysqli->query($query);
   if (!$mysqli) {
       throw new Exception($mysqli->error);
   } else {
       echo "tabel admin berhasil dihapus <br>";
   }

   // buat query untuk CREATE tabel user
  $query  = "CREATE TABLE admin (username VARCHAR(50), password CHAR(40))";
  $mysqli->query($query);
  if (!$mysqli) {
      throw new Exception($mysqli->error);
  } else {
      echo "tabel admin berhasil dibuat <br>";
  }

  
 // buat username dan password untuk admin
 $username = "admin123";
 $password = sha1("admin123");

  // buat query untuk INSERT data ke tabel admin
  $query  = "INSERT INTO admin VALUES ('$username','$password')";
  $mysqli->query($query);
  if (!$mysqli) {
      throw new Exception($mysqli->error);
  } else {
      echo "tabel user berhasil diisi <br>";
  }





} catch (Exception $e) {
    echo "query gagal" . $e->getMessage() . "" . $e->getCode();
}
