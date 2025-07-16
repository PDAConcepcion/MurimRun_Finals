<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/header.css">
    <link rel="stylesheet" href="/assets/css/footer.css">

</head>

<body>
    <?php
    include TEMPLATES_PATH . '/header.component.php';
    ?>

    <main>

        <div class="content">

            <h1>Welcome to Admin Dashboard</h1>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ipsum neque, venenatis nec sagittis
                in,
                volutpat vel nisl. Nullam pulvinar ante vulputate dolor egestas dictum. Nullam dignissim venenatis
                fermentum. Nulla sagittis est id justo posuere, et sollicitudin magna lacinia. Etiam vulputate magna
                congue
                auctor varius. Nunc arcu dui, posuere eu erat ut, ultrices aliquam felis. Nam cursus libero et consequat
                venenatis. Aenean a elit vitae turpis dignissim fermentum. Vestibulum arcu velit, porttitor eu lectus
                gravida, feugiat porta sem. Proin eleifend varius varius.
            </p>
            <p>
                Aliquam ac malesuada enim. Quisque id ornare turpis. Duis egestas porta sapien a laoreet. Fusce magna
                arcu,
                fermentum vel urna sed, dictum fringilla sapien. Pellentesque habitant morbi tristique senectus et netus
                et
                malesuada fames ac turpis egestas. Curabitur convallis mi vehicula, gravida odio nec, elementum dolor.
                Praesent porta accumsan sodales. Aenean gravida tristique maximus.
            </p>

            <div class="btn-actions">
                <a href="/pages/signupPage/index.php">
                    <button class="btn">
                        Log out
                    </button>
                </a>
            </div>
        </div>


    </main>

    <?php
    include TEMPLATES_PATH . '/footer.component.php'
        ?>
</body>

</html>