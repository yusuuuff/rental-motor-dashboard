<?php

session_start();

require '../config/koneksi.php';

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit;
}

include '../templates/header.php';
include '../templates/sidebar.php';

$data = $pdo->query("SELECT * FROM motor");

?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold m-0">Data Motor</h2>
    <a href="tambah.php" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Tambah Motor
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Nama Motor</th>
                        <th>Jenis</th>
                        <th>Harga Sewa</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $motor): ?>
                    <tr>
                        <td class="ps-4 text-muted small">#<?= $motor['id']; ?></td>
                        <td class="fw-bold"><?= $motor['nama_motor']; ?></td>
                        <td><span class="badge bg-light text-dark fw-normal"><?= $motor['jenis']; ?></span></td>
                        <td>Rp <?= number_format($motor['harga_sewa']); ?>/hari</td>
                        <td>
                            <?php if($motor['status'] == 'Tersedia'): ?>
                                <span class="badge bg-success-subtle text-success px-3">Tersedia</span>
                            <?php else: ?>
                                <span class="badge bg-danger-subtle text-danger px-3">Disewa</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-end pe-4">
                            <a href="edit.php?id=<?= $motor['id']; ?>" class="btn btn-light btn-sm me-1">
                                <i class="bi bi-pencil text-warning"></i>
                            </a>
                            <a href="hapus.php?id=<?= $motor['id']; ?>" class="btn btn-light btn-sm" 
                               onclick="return confirm('Yakin ingin menghapus data ini?')">
                                <i class="bi bi-trash text-danger"></i>
                            </a>
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