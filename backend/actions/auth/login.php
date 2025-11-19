<?php
session_start();
require_once __DIR__ . '/../../../config/connection.php';

$error = '';
$username = '';
$password = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($connect, trim($_POST['username'] ?? ''));
    $password = trim($_POST['password'] ?? '');

    if ($username === '' || $password === '') {
        $error = "Username dan password wajib diisi!";
    } else {
        // Ganti tabel ke "admin" sesuai database
        $query = mysqli_query($connect, "SELECT * FROM admin WHERE username = '$username' LIMIT 1");

        if ($query && mysqli_num_rows($query) > 0) {
            $user = mysqli_fetch_assoc($query);

            if (!empty($user['password'])) {
                if (password_verify($password, $user['password'])) {

                    // Simpan data ke session
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['nama_lengkap'] = $user['nama_lengkap'] ?? '';
                    $_SESSION['email'] = $user['email'] ?? '';
                    $_SESSION['foto'] = $user['foto'] ?? '';

                    // Tentukan role berdasarkan username
                    $usernameLower = strtolower(trim($user['username']));

                    if ($usernameLower === 'shinta@gmail.com') {
                        $_SESSION['role'] = 'admin';
                        $_SESSION['login_success'] = "Berhasil login sebagai Admin!";
                        header("Location: ../../pages/dashboard/index.php");
                        exit;
                    } elseif ($usernameLower === 'anisa@gmail.com') {
                        $_SESSION['role'] = 'operator';
                        $_SESSION['login_success'] = "Berhasil login sebagai Operator!";
                        header("Location: ../../pages/profil_kelurahan/index.php");
                        exit;
                    } elseif ($usernameLower === 'ana@gmail.com') {
                        $_SESSION['role'] = 'pengunjung';
                        $_SESSION['login_success'] = "Berhasil login sebagai Pengunjung!";
                        header("Location: ../../pages/profil_kelurahan/index.php");
                        exit;
                    } else {
                        $_SESSION['role'] = 'user';
                        $_SESSION['login_success'] = "Login berhasil!";
                        header("Location: ../../pages/berita/index.php");
                        exit;
                    }
                } else {
                    $error = "Password salah!";
                }
            } else {
                $error = "Data user tidak valid (kolom password kosong)!";
            }
        } else {
            $error = "Username tidak ditemukan!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login | Kelurahan Tonrorita</title>
    <link rel="icon" type="image/png" sizes="128x128" href="../../templates-admin/material-dashboard-2/assets/img/logokelurah-removebg-preview.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: linear-gradient(135deg, #0f172a, #1e3a8a, #2563eb);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
        }

        .login-card {
            width: 380px;
            border-radius: 15px;
            background: linear-gradient(160deg, #b0b9ff 0%, #d9dfff 40%, #e7eafc 100%);
            color: #1e293b;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.25);
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .login-card:hover {
            transform: translateY(-3px);
        }

        .login-card img {
            width: 80px;
            height: 80px;
            object-fit: cover;
        }

        h4 {
            color: #1e293b;
            font-weight: 700;
        }

        .btn-login {
            background: linear-gradient(90deg, rgb(33, 88, 177), #1e40af);
            color: white;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: linear-gradient(90deg, #2563eb, #1d4ed8);
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid rgb(35, 88, 153);
        }

        .form-control:focus {
            border-color: rgb(118, 152, 207);
            box-shadow: 0 0 0 0.2rem rgba(155, 178, 216, 0.25);
        }

        a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 500;
        }

        a:hover {
            text-decoration: underline;
        }

        .sub-link {
            color: #475569;
        }
    </style>
</head>

<body>
    <div class="card login-card shadow-lg p-4 text-center">
        <img src="../../templates-admin/material-dashboard-2/assets/img/logokelurah-removebg-preview.png" alt="Logo" class="mx-auto mb-3">
        <h4 class="fw-bold mb-1">Selamat Datang Di Aplikasi Kelurahan Tonrorita</h4>
        <p class="mb-4 text-muted">Silakan login terlebih dahulu!</p>

        <?php if (!empty($error)) : ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Login',
                    text: '<?= htmlspecialchars($error, ENT_QUOTES) ?>',
                    confirmButtonColor: '#2563eb'
                });
            </script>
        <?php endif; ?>

        <form method="POST" autocomplete="off">
            <div class="mb-3 text-start">
                <input type="text" name="username" class="form-control" placeholder="Username"
                    required value="<?= htmlspecialchars($username, ENT_QUOTES) ?>">
            </div>
            <div class="mb-3 text-start">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-login w-100">Login</button>
        </form>
    </div>
</body>

</html>