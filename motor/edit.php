<?php

session_start();

require '../config/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

$stmt = $pdo->prepare("
    SELECT * FROM motor
    WHERE id = ?
");

$stmt->execute([$id]);

$motor = $stmt->fetch();

if (!$motor) {
    die("Data motor tidak ditemukan.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama_motor = $_POST['nama_motor'];
    $jenis      = $_POST['jenis'];
    $harga      = $_POST['harga'];
    $status     = $_POST['status'];

    $update = $pdo->prepare("
        UPDATE motor
        SET
            nama_motor = ?,
            jenis = ?,
            harga_sewa = ?,
            status = ?
        WHERE id = ?
    ");

    $update->execute([
        $nama_motor,
        $jenis,
        $harga,
        $status,
        $id
    ]);

    header("Location: index.php");
    exit;
}

include '../templates/header.php';
include '../templates/sidebar.php';

?>

<div class="container">

    <h2 class="mb-4">Edit Motor</h2>

    <div class="card">

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">

                    <label class="form-label">
                        Nama Motor
                    </label>

                    <input
                        type="text"
                        name="nama_motor"
                        class="form-control"
                        value="<?= htmlspecialchars($motor['nama_motor']) ?>"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Jenis Motor
                    </label>

                    <input
                        type="text"
                        name="jenis"
                        class="form-control"
                        value="<?= htmlspecialchars($motor['jenis']) ?>"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Harga Sewa per Hari
                    </label>

                    <input
                        type="number"
                        name="harga"
                        class="form-control"
                        value="<?= $motor['harga_sewa'] ?>"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Status
                    </label>

                    <select
                        name="status"
                        class="form-select">

                        <option
                            value="Tersedia"
                            <?= $motor['status'] == 'Tersedia' ? 'selected' : '' ?>>
                            Tersedia
                        </option>

                        <option
                            value="Disewa"
                            <?= $motor['status'] == 'Disewa' ? 'selected' : '' ?>>
                            Disewa
                        </option>

                    </select>

                </div>

                <button
                    type="submit"
                    class="btn btn-warning">

                    Update

                </button>

                <a
                    href="index.php"
                    class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>

<?php

include '../templates/footer.php';

?>