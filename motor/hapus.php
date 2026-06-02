<?php

session_start();

require '../config/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$id = $_GET['id'];

$stmt = $pdo->prepare("
DELETE FROM motor
WHERE id=?
");

$stmt->execute([$id]);

header("Location: index.php");
exit;