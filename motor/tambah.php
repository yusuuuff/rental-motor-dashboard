<?php

session_start();

require '../config/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

if (isset($_POST['nama_motor'])) {

    $nama_motor = $_POST['nama_motor'];
    $jenis      = $_POST['jenis'];
    $harga      = $_POST['harga'];
    $status     = $_POST['status'];

    $stmt = $pdo->prepare("
        INSERT INTO motor
        (nama_motor, jenis, harga_sewa, status)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->execute([
        $nama_motor,
        $jenis,
        $harga,
        $status
    ]);

    header("Location: index.php");
    exit;
}

include '../templates/header.php';
include '../templates/sidebar.php';

?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold m-0">Tambah Motor Baru</h2>
    <a href="index.php" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold small text-muted text-uppercase">Nama Motor</label>
                            <input type="text" name="nama_motor" class="form-control" placeholder="Contoh: Honda Vario 160" required>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold small text-muted text-uppercase">Jenis Motor</label>
                            <input type="text" name="jenis" class="form-control" placeholder="Matic / Sport / Bebek" required>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold small text-muted text-uppercase">Harga Sewa per Hari</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">Rp</span>
                                <input type="number" name="harga" class="form-control border-start-0" placeholder="000.000" required>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold small text-muted text-uppercase">Status</label>
                            <select name="status" class="form-select">
                                <option value="Tersedia">Tersedia</option>
                                <option value="Disewa">Disewa</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-grid mt-2">
                        <button type="submit" class="btn btn-primary py-3 fw-bold">
                            <i class="bi bi-save me-2"></i> Simpan Data Motor
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

include '../templates/footer.php';

?>