/* scripts.js */
document.addEventListener('DOMContentLoaded', () => {
    const registerForm = document.getElementById('registerForm');
    const loginForm = document.getElementById('loginForm');
    const taskForm = document.getElementById('taskForm');
    const message = document.getElementById('message');

    if (registerForm) {
        registerForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const response = await fetch('register.php', {
                method: 'POST',
                body: new FormData(registerForm)
            });
            const result = await response.text();
            message.textContent = result;
        });
    }

    if (loginForm) {
        loginForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const response = await fetch('login.php', {
                method: 'POST',
                body: new FormData(loginForm)
            });
            const result = await response.text();
            if (result === 'Login successful') {
                window.location.href = 'dashboard.php';
            } else {
                message.textContent = result;
            }
        });
    }

    if (taskForm) {
        taskForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const response = await fetch('add_task.php', {
                method: 'POST',
                body: new FormData(taskForm)
            });
            const result = await response.text();
            if (result === 'Task added') {
                window.location.reload();
            } else {
                alert(result);
            }
        });
    }
});