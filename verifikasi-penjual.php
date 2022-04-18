<?php
session_start();
//cek login level pembeli
if(!isset($_SESSION["login"]) || $_SESSION['level1']!='pembeli'){
  header("location:masuk.php");
}if(!isset($_SESSION["login"]) || $_SESSION['level2']=='penjual'){
  header("location:penjualan.php");
}

include "koneksi.php";
if(isset($_POST["submit"])) {
  $id_user = $_POST["id_user"];
  $level2 = $_POST["level2"];

  $query = "UPDATE user_loakan SET 
            level2='$level2' 
            WHERE id_user=$id_user";
  mysqli_query($conn, $query);
  if(mysqli_affected_rows($conn) > 0) {
    echo "
    <script>
      alert('Selamat, anda telah terdaftar menjadi penjual di Loakan!');
      document.location.href='penjualan.php';   
    </script>   
    ";
  } else {
    echo "
    <script>
      alert('Maaf, anda gagal meendaftar menjadi penjual di Loakan. Silahkan coba kembali :(');
      document.location.href='verifikasi-penjual.php';
    </script>
    ";
  }
}
$email1 = $_SESSION['email'];
$query1 = "SELECT * FROM user_loakan WHERE email = '$email1'";
$result1 = mysqli_query($conn, $query1);
?>
<?php
if(mysqli_num_rows($result1) > 0){
  $data_user_tanisell = mysqli_fetch_array($result1);
  $_SESSION["id_user"] = $data_user_tanisell["id_user"];
  $_SESSION["level2"] = $data_user_tanisell["level2"];
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Verifikasi Penjual | Loakan</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="icon" href="img/logo1.png" />
    <!--Fontawnsome-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous" />
  </head>
  <body style="background-color: rgba(188, 227, 243)">
    <!--Bagian atas-->
    <div class="text-center p-0" style="background-color: rgb(255, 255, 255)">
      <a class="text-dark" href="https://mdbootstrap.com/"><i class="fab fa-facebook"></i></a>
      <a class="text-dark" href="https://mdbootstrap.com/"><i class="fab fa-youtube"></i></a>
      <a class="text-dark me-3" href="https://mdbootstrap.com/"><i class="fab fa-instagram-square"></i></a>
      <a class="text-dark garis-bawah" href="syarat-ketentuan-after.php">*Syarat & Ketentuan</a>
    </div>

    <!--Bagian Navbar-->
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark shadow">
      <!--Bagian navbar-->
      <div class="container">
        <a class="navbar-brand" href="index-after.php">
          <img src="img/logo2.png" alt="" width="120px" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="index-after.php">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="verifikasi-penjual.php">Penjualan</a>
            </li>
            <li class="nav-item me-5">
              <a class="nav-link" href="tentang-after.php">Tentang</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn bg-white me-1" style="height: 42px; font-weight: bold; color: darkslategray" href="akun.php"><i class="fas fa-user-alt"></i> Akun</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn bg-white me-1" style="height: 42px; font-weight: bold; color: darkslategray" href="logout.php"><i class="fas fa-sign-out-alt"></i> Keluar</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!--Akhir bagian Navbar-->

    <!--BAGIAN BODY-->
    <div class="container mt-5 text-center">
      <h3>Yuk ikut menjadi penjual dan ramaikan penjualan di <strong>Loakan</strong></h3>
      <h3>Klik Daftar Segara!!!</h3>
      <p><br></p>

      <table width="30%" border="1" align="center" cellpadding="20">
        <tr>
          <td>
            <form action="" method="POST" class="was-validated">
            <div class="form-check">
              <input type="hidden" name="id_user" value="<?= $_SESSION["id_user"]; ?>" />
              <input class="form-check-input" type="checkbox" value="penjual" id="level2" name="level2" required/>
              <label class="form-check-label" for="invalidCheck">Menyetujui <a href="syarat-ketentuan-after.php" class="text-dark">Syarat & Ketentuan</a> yang ada.</label>
              <div class="invalid-feedback text-start">"Kotak harus terceklis"</div>
            </div>
            <div class="mt-2">
              <p><br></p>
              <button type="submit" name="submit" class="btn btn-success" style="font-weight: bold;">Daftar Menjadi Penjual</button>
            </div>
            </form>
          </td>
        </tr>
      </table>
    <p class="mt-5"></p>

    <!--Bagian Footer-->
    <section class="">
      <!-- Footer -->
      <footer class="text-white text-center fixed-bottom">
        <!-- Grid container -->
        <div class="container p-4">
          <!--Grid row-->
          <div class="row">
            <!--Grid column-->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
              <h5 class="text-uppercase"><img src="img/logo2.png" alt="" width="120px" /></h5>
              <ul class="list-unstyled mb-0">
                <br />
                <li>
                  <a href="tentang-after.php" class="text-white garis-bawah">Tentang kami</a>
                </li>
                <li>
                  <a href="#!" class="text-white garis-bawah">Kontak kami</a>
                </li>
              </ul>
            </div>
            <!--Grid column-->
            <!--Grid column-->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
              <h5 class="text-uppercase mb-0">Sosial Media</h5>
              <ul class="list-unstyled">
                <br />
                <li>
                  <a href="#!" class="text-white garis-bawah"><i class="fab fa-facebook"></i> Loakan</a>
                </li>
                <li>
                  <a href="#!" class="text-white garis-bawah"><i class="fab fa-youtube"></i> Loakan</a>
                </li>
                <li>
                  <a href="#!" class="text-white garis-bawah"><i class="fab fa-instagram-square"></i> loakan</a>
                </li>
              </ul>
            </div>
            <!--Grid column-->
            <!--Grid column-->
            <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
              <h5 class="text-uppercase">Kontak</h5>
              <ul class="list-unstyled mb-0">
                <br />
                <li>
                  <a href="tentang.html" class="text-white garis-bawah">
                    <strong><i class="fas fa-map-marker-alt"></i> Alamat </strong>: Desa Bakung Kecamatan Mijen Kabupaten Demak
                  </a>
                </li>
                <li>
                  <a href="#!" class="text-white garis-bawah">
                    <strong><i class="fab fa-whatsapp"></i> WhatsApp </strong>: 082328882434
                  </a>
                </li>
                <li>
                  <a href="#!" class="text-white garis-bawah">
                    <strong><i class="fas fa-envelope"></i> Email </strong>: luqmannurbuat@gmail.com
                  </a>
                </li>
              </ul>
            </div>
            <!--Grid column-->
          </div>
          <!--Grid row-->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
          © 2022 By :
          <a class="text-white" href="https://github.com/Luqman-Noor-Buat/">Luqman Noor Buat</a>
        </div>
        <!-- Copyright -->
      </footer>
      <!-- Footer -->
    </section>
    <!--Akhir Bagian Footer-->
  </body>
</html>
