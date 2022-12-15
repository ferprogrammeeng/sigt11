<?php
session_start();
if (!isset($_SESSION["nama"])) {
  header("Location: login.php");
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
                    <h4>Data Lokasi</h4>
                    <table border="0" class="table">
                        <thead>
                            <th>No</th>
                            <th>Nama Kost</th>
                            <th>Harga</th>
                            <th>Nama Penyewa</th>
                            <th>lat</th>
                            <th>lng</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            <?php
                            include("koneksi.php");
                            $sql = "SELECT * FROM lokasi ";
                            $result = mysqli_query($conn, $sql);
                            $no = 1;
                            //buat perulangan untuk element tabel dari data mahasiswa
                            while($data = mysqli_fetch_assoc($result))
                            {
                              echo "<tr>";
                              echo "<td>$no</td>";
                              echo "<td>$data[nama_kost]</td>";
                              echo "<td>$data[harga]</td>";
                              echo "<td>$data[nama_penyewa]</td>";
                              echo "<td>$data[lat]</td>";
                              echo "<td>$data[lng]</td>";
                              echo "<td>";
                              $no++;
                              ?>
                                <form action="edit-lokasi.php" method="post" >
                                <input type="hidden" name="nama_kost" value="<?php echo "$data[nama_kost]"; ?>" >
                                <input type="submit" name="submit" value="Edit" >
                                </form>
                              <?php
                              echo "</td>";
                              echo "</tr>";
                            }
                            ?>
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