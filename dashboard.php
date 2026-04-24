<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['name'])) {
    header("Location: index.php");
    exit();
}

$name        = $_SESSION['name'];
$today       = date('F j, Y - h:i A');
$last_visit  = isset($_COOKIE['last_visit']) ? $_COOKIE['last_visit'] : null;

// Update the cookie to current time for next visit
setcookie('last_visit', date('F j, Y - h:i A'), time() + 86400, '/');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Check-In Tracker — Dashboard</title>
    <meta name="description" content="Your Daily Check-In Dashboard showing your current visit info and last visit history.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="dashboard-body">
    <div class="page-wrapper">
        <!-- Top bar -->
        <div class="top-bar">
            <div class="brand">
                <span class="brand-icon">📋</span>
                <span class="brand-text">Daily Check-In</span>
            </div>
            <span class="status-badge">
                <span class="status-dot"></span>
                Active Session
            </span>
        </div>

        <!-- Dashboard card -->
        <div class="dashboard-card">

            <!-- Welcome banner -->
            <div class="welcome-banner">
                <div class="avatar">👋</div>
                <div class="welcome-text">
                    <h2>Welcome, <?= $name ?>!</h2>
                    <p>Here's your check-in summary for today.</p>
                </div>
            </div>

            <!-- Info items -->
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-dot today-dot">🗓️</div>
                    <div>
                        <div class="info-label">Today is</div>
                        <div class="info-value today-val"><?= $today ?></div>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-dot last-dot">🕐</div>
                    <div>
                        <div class="info-label">Your last visit was</div>
                        <div class="info-value last-val">
                            <?php if ($last_visit): ?>
                                <?= htmlspecialchars($last_visit) ?>
                            <?php else: ?>
                                <span class="no-visit">No previous visit recorded</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logout -->
            <a href="logout.php" class="btn-logout" id="logout-btn">
                🚪 Logout
            </a>

        </div>
    </div>
</body>
</html>
