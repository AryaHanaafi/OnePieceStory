<?php
include "koneksi.php";
include "upload_foto.php";

// Pastikan pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Ambil username dari sesi
$username = $_SESSION['username'];

// Ambil data user berdasarkan username
$sql = "SELECT * FROM user WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Jika tombol simpan ditekan
if (isset($_POST['simpan'])) {
    $new_username = !empty($_POST['username']) ? $_POST['username'] : $username;
    $password = !empty($_POST['password']) ? md5($_POST['password']) : $user['password'];
    $foto = $user['foto'];

    // Validasi jika username baru berbeda dengan yang lama
    if ($new_username !== $username) {
        $check_username = $conn->prepare("SELECT * FROM user WHERE username = ?");
        $check_username->bind_param("s", $new_username);
        $check_username->execute();
        $result_check = $check_username->get_result();

        if ($result_check->num_rows > 0) {
            echo "<script>alert('Username sudah digunakan!');</script>";
        } else {
            $username = $new_username; // Update username jika tidak ada yang sama
        }
    }

    // Proses upload foto baru
    if (!empty($_FILES['foto']['name'])) {
        $cek_upload = upload_foto($_FILES['foto']);

        if ($cek_upload['status']) {
            $foto = $cek_upload['message'];

            // Hapus foto lama jika ada
            if (!empty($user['foto']) && file_exists('img/' . $user['foto'])) {
                unlink('img/' . $user['foto']);
            }
        } else {
            echo "<script>alert('" . $cek_upload['message'] . "');</script>";
        }
    }

    // Update data user
    $stmt = $conn->prepare("UPDATE user SET username = ?, password = ?, foto = ? WHERE username = ?");
    $stmt->bind_param("ssss", $username, $password, $foto, $user['username']);

    if ($stmt->execute()) {
        // Perbarui session dengan username baru
        $_SESSION['username'] = $username;
        echo "<script>alert('Data berhasil diperbarui!'); window.location='admin.php?page=profile';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data!');</script>";
    }
}

$stmt->close();
$conn->close();
?>

<form method="post" action="" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="username" class="form-label">Username Baru</label>
        <input type="text" class="form-control" name="username" id="username"
            placeholder="Tuliskan Username jika ingin mengganti Username">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password Baru</label>
        <div class="input-group">
            <input type="password" class="form-control" name="password" id="password"
                placeholder="Tuliskan Password baru jika ingin mengganti Password">
            <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                <i class="bi bi-eye-slash" id="eyeIcon"></i>
            </button>
        </div>
    </div>
    <div class="mb-3">
        <label for="foto" class="form-label">Ganti Foto Profile</label>
        <input type="file" class="form-control" name="foto">
    </div>
    <div class="mb-3">
        <label for="foto_lama" class="form-label">Foto Lama</label><br>
        <?php if (!empty($user['foto']) && file_exists('img/' . $user['foto'])): ?>
            <img src="img/<?= $user['foto'] ?>" width="100">
        <?php else: ?>
            <p>Tidak ada foto</p>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <input type="submit" value="Simpan" name="simpan" class="btn btn-primary">
    </div>
</form>

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