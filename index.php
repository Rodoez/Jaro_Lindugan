<?php
session_start();

// If user is already logged in, redirect to dashboard
if (isset($_SESSION['name'])) {
    header("Location: dashboard.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    if (!empty($name)) {
        $_SESSION['name'] = htmlspecialchars($name);

        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Please enter your name.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Check-In Tracker — Login</title>
    <meta name="description" content="Log in to your Daily Check-In Tracker to record your visit and track your activity.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <div class="logo-icon">📋</div>
            <h1>Daily Check-In</h1>
            <p>Track your daily visits effortlessly</p>
        </div>

        <div class="card">
            <p class="card-title">Welcome back!</p>
            <p class="card-subtitle">Enter your name to check in for today.</p>

            <?php if (!empty($error)): ?>
                <div class="error-msg" role="alert">
                    <span>⚠️</span> <?= $error ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="index.php" id="login-form">
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <div class="input-wrapper">
                        <span class="input-icon">👤</span>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            placeholder="e.g. Bernice"
                            autocomplete="off"
                            autofocus
                            value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>"
                        >
                    </div>
                </div>

                <button type="submit" class="btn-primary" id="check-in-btn">
                    ✅ Check In
                </button>
            </form>

            <p class="footer-note">Your session is private and secure on this device.</p>
        </div>
    </div>
</body>
</html>
