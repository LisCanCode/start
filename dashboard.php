<!-- dashboard.php -->
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit;
}
require 'config.php';
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id = ?");
$stmt->execute([$user_id]);
$tasks = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskySaaS - Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>TaskySaaS Dashboard</h1>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>! <a href="logout.php">Logout</a></p>
        <div class="task-box">
            <h2>Add Task</h2>
            <form id="taskForm" action="add_task.php" method="POST">
                <input type="text" name="task" placeholder="Enter task" required>
                <button type="submit">Add Task</button>
            </form>
            <h2>Your Tasks</h2>
            <ul id="taskList">
                <?php foreach ($tasks as $task): ?>
                    <li>
                        <?php echo htmlspecialchars($task['task']); ?>
                        <a href="delete_task.php?id=<?php echo $task['id']; ?>" onclick="return confirm('Delete this task?')">Delete</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <script src="scripts.js"></script>
</body>
</html>