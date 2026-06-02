<?php

session_start();
require '../config/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$data = $pdo->query("
SELECT
    transaksi.*,
    users.nama,
    motor.nama_motor

FROM transaksi

JOIN users
ON transaksi.user_id = users.id

JOIN motor
ON transaksi.motor_id = motor.id

ORDER BY transaksi.id DESC
");

include '../templates/header.php';
include '../templates/sidebar.php';

?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold m-0">Data Transaksi</h2>
    <a href="tambah.php" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Tambah Transaksi
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Penyewa</th>
                        <th>Motor</th>
                        <th>Tanggal Sewa</th>
                        <th>Tanggal Kembali</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $row): ?>
                    <tr>
                        <td class="ps-4 text-muted small">#<?= $row['id']; ?></td>
                        <td class="fw-bold text-primary"><?= $row['nama']; ?></td>
                        <td><?= $row['nama_motor']; ?></td>
                        <td><i class="bi bi-calendar-event me-1 text-muted"></i> <?= $row['tanggal_sewa']; ?></td>
                        <td><i class="bi bi-calendar-check me-1 text-muted"></i> <?= $row['tanggal_kembali']; ?></td>
                        <td class="fw-bold">Rp <?= number_format($row['total_harga']); ?></td>
                        <td>
                            <?php if($row['status'] == 'Aktif'): ?>
                                <span class="badge bg-primary-subtle text-primary px-3">Aktif</span>
                            <?php else: ?>
                                <span class="badge bg-secondary-subtle text-secondary px-3">Selesai</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-end pe-4">
                            <?php if($row['status'] == 'Aktif'): ?>
                            <a href="selesai.php?id=<?= $row['id']; ?>" class="btn btn-success btn-sm px-3">
                                <i class="bi bi-check-circle me-1"></i> Selesai
                            </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include '../templates/footer.php';
?>