<?php
// Memulai session atau melanjutkan session yang sudah ada
session_start();

// Menyertakan code dari file koneksi
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['user'];

  // Menggunakan fungsi enkripsi md5 supaya sama dengan password yang tersimpan di database
  $password = md5($_POST['pass']);

  // Prepared statement
  $stmt = $conn->prepare("SELECT username FROM user WHERE username=? AND password=?");

  // Parameter binding 
  $stmt->bind_param("ss", $username, $password); // username string dan password string

  // Database executes the statement
  $stmt->execute();

  // Menampung hasil eksekusi
  $hasil = $stmt->get_result();

  // Mengambil baris dari hasil sebagai array asosiatif
  $row = $hasil->fetch_array(MYSQLI_ASSOC);

  // Check apakah ada baris hasil data user yang cocok
  if (!empty($row)) {
    // Jika ada, simpan variable username pada session
    $_SESSION['username'] = $row['username'];

    // Simpan pesan sukses pada session
    $_SESSION['message'] = "<div class='alert alert-success text-center'>Login berhasil! Selamat datang, $username.</div>";

    // Mengalihkan ke halaman admin
    header("location:admin.php");
  } else {
    // Jika tidak ada (gagal), simpan pesan error pada session
    $_SESSION['message'] = "<div class='alert alert-danger text-center'>Login gagal! Username atau password salah.</div>";

    // Alihkan kembali ke halaman login
    header("location:login.php");
  }

  // Menutup koneksi database
  $stmt->close();
  $conn->close();
} else {
  ?>

  <!doctype html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Nakama</title>
    <link rel="icon" href="https://i.pinimg.com/564x/ab/a6/bb/aba6bb42cb08e35ac0d71e6044566b0a.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <style>
    body {
      background-image: url('https://i.pinimg.com/736x/d5/db/9a/d5db9a7d30b76a6737c596cff4936c8e.jpg');
      background-size: cover;
      background-repeat: no-repeat;
    }

    .card {
      backdrop-filter: blur(0px) saturate(78%);
      -webkit-backdrop-filter: blur(0px) saturate(78%);
      background-color: rgba(17, 25, 40, 0.25);
      border: 1px solid rgba(255, 255, 255, 0.125);
    }
  </style>

  <body>
    <div class="container mt-5 pt-5">
      <div class="row">
        <div class="col-12 col-sm-8 col-md-6 m-auto">
          <div class="card border-0 shadow rounded-5">
            <div class="card-body">
              <div class="text-center mb-3">
                <i class="bi bi-person-circle h1 display-4"></i>
                <p>Login</p>
                <hr />
              </div>
              <!-- Tempat untuk menampilkan pesan -->
              <?php if (isset($_SESSION['message'])): ?>
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']); // Hapus pesan setelah ditampilkan
                ?>
              <?php endif; ?>

              <!-- Form Login -->
              <form action="" method="post">
                <input type="text" name="user" class="form-control my-4 py-2 rounded-4" placeholder="Username" required />
                <input type="password" name="pass" class="form-control my-4 py-2 rounded-4" placeholder="Password"
                  required />
                <div class="text-center my-3 d-grid">
                  <button class="btn bg-info-subtle rounded-4">Login</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
      </script>
  </body>

  </html>
  <?php
}
?>