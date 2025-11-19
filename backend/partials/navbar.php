<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

    <!-- NAVBAR -->
    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Ambil username dari session
    $username = strtolower($_SESSION['Username'] ?? '');

    // Tentukan role + email berdasarkan username
    if ($username === 'admin') {
        $roleName = 'Admin';
        $roleEmail = 'shinta@gmail.com';
    } elseif ($username === 'petugas') {
        $roleName = 'Operator';
        $roleEmail = 'anisa@gmail.com';
    } elseif ($username === 'pengunjung') {
        $roleName = 'Pengunjung';
        $roleEmail = 'ana@gmail.com';
    } else {
        $roleName = 'Tidak diketahui';
        $roleEmail = '-';
    }
    ?>
    <!-- NAVBAR -->
    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center custom-navbar"
        id="layout-navbar">

        <ul class="navbar-nav flex-row align-items-center ms-auto">

            <!-- Tanggal & Jam -->
            <li class="nav-item me-3 text-white fw-semibold">
                <span id="datetime"></span>
            </li>

            <!-- Nama Role + Icon -->
            <li class="nav-item d-flex align-items-center text-white fw-semibold me-3">
                <?= htmlspecialchars($role) ?>
                <img src="../../templates-admin/material-dashboard-2/assets/img/icon.jpg"
                    alt="User Icon"
                    class="rounded-circle ms-2 border border-primary"
                    style="width: 36px; height: 36px; object-fit: cover;" />
            </li>

        </ul>
    </nav>

    <!-- STYLE -->
    <style>
        .custom-navbar {
            background: linear-gradient(90deg, #6c757d, #0d6efd);
            /* abu -> biru */
            color: white !important;
        }

        #datetime {
            font-size: 14px;
        }
    </style>

    <!-- SCRIPT JAM -->
    <script>
        function updateDateTime() {
            const now = new Date();
            const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
            const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

            const dayName = days[now.getDay()];
            const day = String(now.getDate()).padStart(2, '0');
            const month = months[now.getMonth()];
            const year = now.getFullYear();

            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');

            document.getElementById("datetime").textContent =
                `${dayName}, ${day} ${month} ${year} | ${hours}:${minutes}:${seconds}`;
        }

        setInterval(updateDateTime, 1000);
        updateDateTime();
    </script>


    

    <!-- MAIN CONTENT -->
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- isi halaman -->
    </main>


    <!-- CSS -->
    <style>
        .custom-navbar {
            background: linear-gradient(90deg, rgb(102, 204, 230), rgb(17, 107, 129));
            color: white !important;
        }

        .custom-navbar strong,
        .custom-navbar small {
            color: white !important;
        }

        /* Dropdown */
        .custom-navbar .dropdown-menu strong {
            color: #000 !important;
            font-size: 0.95rem;
        }

        .custom-navbar .dropdown-menu small {
            color: #555 !important;
            font-size: 0.8rem;
        }
    </style>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>