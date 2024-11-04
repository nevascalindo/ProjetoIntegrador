<?php
session_start();
require_once '../src/connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] !== 1) {
    header("Location: ../views/login.php");
    exit();
}

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

header("Location: adminusuarios.php");
exit();
?>
