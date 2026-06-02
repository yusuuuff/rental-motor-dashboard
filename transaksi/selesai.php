<?php

require '../config/koneksi.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("
SELECT * FROM transaksi
WHERE id=?
");

$stmt->execute([$id]);

$transaksi = $stmt->fetch();

$update = $pdo->prepare("
UPDATE transaksi
SET status='Selesai'
WHERE id=?
");

$update->execute([$id]);

$motor = $pdo->prepare("
UPDATE motor
SET status='Tersedia'
WHERE id=?
");

$motor->execute([
    $transaksi['motor_id']
]);

header("Location: index.php");