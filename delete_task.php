<!-- delete_task.php -->
<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit;
}

if (isset($_GET['id'])) {
    $task_id = (int)$_GET['id'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ? AND user_id = ?");
    if ($stmt->execute([$task_id, $user_id])) {
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Failed to delete task";
    }
}
?>