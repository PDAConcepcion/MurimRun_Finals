<?php
// Includes the header.
require_once __DIR__ . '/../../components/templates/header.component.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings - MurimRun</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="assets/css/accountPage.css">
</head>
<body>
    <main class="account-page">
        <div class="form-container">
            <h1>Account Settings</h1>

            <form action="../../handlers/updateUsername.handler.php" method="POST" class="account-form">
                <h2>Change Username</h2>
                <div class="form-group">
                    <label for="currentUsername">Current Username</label>
                    <input type="text" id="currentUsername" name="currentUsername" value="user_placeholder" disabled>
                </div>
                <div class="form-group">
                    <label for="newUsername">New Username</label>
                    <input type="text" id="newUsername" name="newUsername" placeholder="Enter your new username" required>
                </div>
                <button type="submit" class="btn btn-primary">Save Username</button>
            </form>

            ' tags.
            -->
            </div>
    </main>
    <?php
    // Includes the footer.
    require_once __DIR__ . '/../../components/templates/footer.component.php';
    ?>
    <script src="assets/js/accountPage.js"></script>
</body>
</html>