<!-- add_task.php -->
<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo "Please log in";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task = trim($_POST['task']);
    $user_id = $_SESSION['user_id'];

    if (empty($task)) {
        echo "Task cannot be empty";
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO tasks (user_id, task) VALUES (?, ?)");
    if ($stmt->execute([$user_id, $task])) {
        echo "Task added";
    } else {
        echo "Failed to add task";
    }
}
?>