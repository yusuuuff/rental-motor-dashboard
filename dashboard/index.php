<?php

session_start();

require '../config/koneksi.php';

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit;
}

$totalMotor = $pdo->query("
SELECT COUNT(*) FROM motor
")->fetchColumn();

include '../templates/header.php';
include '../templates/sidebar.php';

?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold m-0">Dashboard</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item active" aria-current="page">Overview</li>
        </ol>
    </nav>
</div>

<div class="alert alert-white border-0 shadow-sm p-4 mb-4" style="border-radius: 15px;">
    <h4 class="fw-bold">Selamat datang kembali, <?= $_SESSION['nama']; ?>! 👋</h4>
    <p class="text-secondary m-0">Berikut adalah ringkasan operasional rental motor Anda hari ini.</p>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card stat-card border-0 p-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-white-50 text-uppercase fw-bold m-0">Total Unit Motor</h6>
                    <i class="bi bi-bicycle fs-1"></i>
                </div>
                <h2 class="fw-bold mb-0"><?= $totalMotor ?></h2>
                <small class="text-white-50">Tersedia untuk disewakan</small>
            </div>
        </div>
    </div>
    
    <!-- Placeholder untuk statistik lain -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-secondary text-uppercase fw-bold m-0">Transaksi Aktif</h6>
                    <div class="bg-primary bg-opacity-10 p-2 rounded">
                        <i class="bi bi-arrow-repeat text-primary fs-4"></i>
                    </div>
                </div>
                <h2 class="fw-bold mb-0">8</h2>
                <small class="text-success"><i class="bi bi-graph-up me-1"></i> +2 hari ini</small>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm p-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-secondary text-uppercase fw-bold m-0">Pendapatan Bulan Ini</h6>
                    <div class="bg-success bg-opacity-10 p-2 rounded">
                        <i class="bi bi-wallet2 text-success fs-4"></i>
                    </div>
                </div>
                <h2 class="fw-bold mb-0">Rp 4.5M</h2>
                <small class="text-secondary">Total estimasi</small>
            </div>
        </div>
    </div>
</div>

<?php

include '../templates/footer.php';

?>