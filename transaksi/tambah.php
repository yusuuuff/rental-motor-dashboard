<?php

session_start();
require '../config/koneksi.php';

$users = $pdo->query("
SELECT * FROM users
WHERE role='user'
");

$motor = $pdo->query("
SELECT * FROM motor
WHERE status='Tersedia'
");

if(isset($_POST['nama_penyewa'])){

    $nama_penyewa = $_POST['nama_penyewa'];
    $motor_id = $_POST['motor_id'];
    $tanggal_sewa = $_POST['tanggal_sewa'];
    $tanggal_kembali = $_POST['tanggal_kembali'];
    $harga = $_POST['harga'];

    // 1. Simpan penyewa baru ke tabel users
    $stmtUser = $pdo->prepare("
        INSERT INTO users (nama, email, password, role)
        VALUES (?, ?, ?, ?)
    ");
    // Gunakan placeholder untuk email dan password
    $email_placeholder = strtolower(str_replace(' ', '', $nama_penyewa)) . rand(100, 999) . "@example.com";
    $password_placeholder = password_hash('123456', PASSWORD_DEFAULT);
    
    $stmtUser->execute([
        $nama_penyewa,
        $email_placeholder,
        $password_placeholder,
        'user'
    ]);
    
    $user_id = $pdo->lastInsertId();

    // 2. Simpan transaksi
    $stmt = $pdo->prepare("
    INSERT INTO transaksi
    (
        user_id,
        motor_id,
        tanggal_sewa,
        tanggal_kembali,
        total_harga,
        status
    )
    VALUES
        (?, ?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        $user_id,
        $motor_id,
        $tanggal_sewa,
        $tanggal_kembali,
        $harga,
        'Aktif'
    ]);

    $updateMotor = $pdo->prepare("
    UPDATE motor
    SET status='Disewa'
    WHERE id=?
    ");

    $updateMotor->execute([$motor_id]);

    header("Location: index.php");
    exit;
}

include '../templates/header.php';
include '../templates/sidebar.php';

?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold m-0">Tambah Transaksi Baru</h2>
    <a href="index.php" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form method="POST">
                    <div class="row">
                        <!-- Informasi Penyewa -->
                        <div class="col-md-12 mb-4">
                            <h5 class="fw-bold border-bottom pb-2 mb-3">Informasi Penyewa</h5>
                            <label class="form-label fw-bold small text-muted text-uppercase">Nama Lengkap Penyewa</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-person"></i></span>
                                <input type="text" name="nama_penyewa" class="form-control border-start-0" placeholder="Masukkan nama lengkap penyewa" required>
                            </div>
                        </div>

                        <!-- Informasi Motor -->
                        <div class="col-md-6 mb-4">
                            <h5 class="fw-bold border-bottom pb-2 mb-3">Pilihan Motor</h5>
                            <label class="form-label fw-bold small text-muted text-uppercase">Motor Tersedia</label>
                            <select name="motor_id" id="motor_id" class="form-select" required>
                                <option value="" disabled selected>Pilih Motor...</option>
                                <?php foreach($motor as $m): ?>
                                <option value="<?= $m['id']; ?>" data-harga="<?= $m['harga_sewa']; ?>">
                                    <?= $m['nama_motor']; ?> (Rp <?= number_format($m['harga_sewa']); ?>/hari)
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Tanggal & Harga -->
                        <div class="col-md-6 mb-4">
                            <h5 class="fw-bold border-bottom pb-2 mb-3">Rincian Sewa</h5>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="form-label fw-bold small text-muted text-uppercase">Dari</label>
                                    <input type="date" name="tanggal_sewa" id="tanggal_sewa" class="form-control" required>
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label fw-bold small text-muted text-uppercase">Hingga</label>
                                    <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-4">
                            <div class="bg-light p-3 rounded-3 mt-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-muted text-uppercase small">Total Harga Sewa</span>
                                    <h3 class="fw-bold text-primary m-0" id="display_total">Rp 0</h3>
                                </div>
                                <input type="hidden" name="harga" id="total_harga">
                            </div>
                        </div>
                    </div>

                    <div class="d-grid mt-2">
                        <button type="submit" class="btn btn-primary py-3 fw-bold shadow-sm">
                            <i class="bi bi-check-circle me-2"></i> Konfirmasi & Simpan Transaksi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

function hitungTotal() {

    let motorSelect = document.getElementById('motor_id');
    if (!motorSelect.value) return;

    let hargaPerHari =
        motorSelect.options[
            motorSelect.selectedIndex
        ].dataset.harga;

    let tglSewa =
        document.getElementById('tanggal_sewa').value;

    let tglKembali =
        document.getElementById('tanggal_kembali').value;

    if(
        hargaPerHari &&
        tglSewa &&
        tglKembali
    ){

        let sewa = new Date(tglSewa);
        let kembali = new Date(tglKembali);

        let selisih =
            (kembali - sewa)
            / (1000 * 60 * 60 * 24);

        if(selisih < 1){
            selisih = 1;
        }

        let total =
            hargaPerHari * selisih;

        document.getElementById(
            'total_harga'
        ).value = total;
        
        document.getElementById(
            'display_total'
        ).innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
    }
}

document
.getElementById('motor_id')
.addEventListener(
    'change',
    hitungTotal
);

document
.getElementById('tanggal_sewa')
.addEventListener(
    'change',
    hitungTotal
);

document
.getElementById('tanggal_kembali')
.addEventListener(
    'change',
    hitungTotal
);

</script>

<?php
include '../templates/footer.php';
?>