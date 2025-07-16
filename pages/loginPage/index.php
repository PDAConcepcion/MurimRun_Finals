<?php

require_once BASE_PATH . '/bootstrap.php';
require_once HANDLERS_PATH . '/postgreChecker.handler.php';
require_once HANDLERS_PATH . '/mongodbChecker.handler.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>

    <link rel="stylesheet" href="/assets/css/header.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <?php
    include TEMPLATES_PATH . '/header.component.php';
    ?>

    <main>
        <div class="content">

            <div class="form-container">
                <div class="logo">
                    <h2>LOGO HERE</h2>
                </div>
                <div class="login-field">
                    <form action="/pages/dashboard/index.php" method="post">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" placeholder="Enter Username" required>
                        <label for="username">Password</label>
                        <input type="text" name="password" id="password" placeholder="Enter Password" required>

                        <div>
                            <button class="btn" type="submit">Submit</button>
                        </div>
                    </form>
                </div>



            </div>
        </div>
    </main>


    <?php
    include TEMPLATES_PATH . '/footer.component.php';
    ?>

</body>

</html>