<?php
// Memulai session atau melanjutkan session yang sudah ada
session_start();

// Menyertakan file koneksi
include "koneksi.php";

// Proses login jika request adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['user'];  // Mendapatkan username dari form login
  $password = md5($_POST['pass']);  // Meng-enkripsi password menggunakan MD5

  // Prepared statement untuk menghindari SQL injection
  $stmt = $conn->prepare("SELECT * FROM user WHERE username=? AND password=?");

  // Mengikat parameter username dan password
  $stmt->bind_param("ss", $username, $password);

  // Menjalankan query
  $stmt->execute();

  // Menampung hasil eksekusi query
  $hasil = $stmt->get_result();

  // Mengambil hasil sebagai array asosiatif
  $row = $hasil->fetch_assoc();

  // Cek apakah username dan password cocok
  if ($row) {
    // Jika cocok, simpan username dalam session
    $_SESSION['username'] = $row['username'];

    // Simpan pesan sukses
    $_SESSION['message'] = "<div class='alert alert-success text-center'>Login berhasil! Selamat datang, $username.</div>";

    // Alihkan ke halaman admin
    header("Location: admin.php");
  } else {
    // Jika gagal, simpan pesan error
    $_SESSION['message'] = "<div class='alert alert-danger text-center'>Login gagal! Username atau password salah.</div>";

    // Alihkan kembali ke halaman login
    header("Location: login.php");
  }

  // Menutup koneksi
  $stmt->close();
  $conn->close();
} else {
  // Halaman login
  ?>
  <!doctype html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Nakama</title>
    <link rel="icon" href="img/logoo.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>

  <style>
    body {
      background-image: url('img/background.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      height: 100vh;
      margin: 0;
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
                <p>One Piece Story</p>
                <hr />
              </div>

              <!-- Tempat untuk menampilkan pesan -->
              <?php if (isset($_SESSION['message'])): ?>
                <?php echo $_SESSION['message'];
                unset($_SESSION['message']); ?>
              <?php endif; ?>

              <!-- Form Login -->
              <form action="" method="post">
                <input type="text" name="user" class="form-control my-4 py-2 rounded-4" placeholder="Username" required />

                <!-- Input Password dengan fitur lihat/sembunyikan -->
                <div class="input-group my-4 position-relative">
                  <input type="password" name="pass" id="password" class="form-control py-2 rounded-4 pe-5"
                    placeholder="Password" required />
                  <span class="position-absolute top-50 end-0 translate-middle-y pe-3" id="togglePassword"
                    style="z-index: 10;">
                    <i class="bi bi-eye-slash" id="eyeIcon"></i>
                  </span>
                </div>


                <div class="text-center my-3 d-grid">
                  <button class="btn bg-info-subtle rounded-4">Login</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
      const togglePassword = document.getElementById('togglePassword');
      const passwordField = document.getElementById('password');
      const eyeIcon = document.getElementById('eyeIcon');

      togglePassword.addEventListener('click', function () {
        const type = passwordField.type === 'password' ? 'text' : 'password';
        passwordField.type = type;

        if (type === 'password') {
          eyeIcon.classList.remove('bi-eye');
          eyeIcon.classList.add('bi-eye-slash');
        } else {
          eyeIcon.classList.remove('bi-eye-slash');
          eyeIcon.classList.add('bi-eye');
        }
      });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
      </script>
  </body>

  </html>
  <?php
}
?>