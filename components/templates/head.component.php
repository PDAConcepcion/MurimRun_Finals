<?php
    require_once UTILS_PATH . "/htmlEscape.util.php";

    // $title = "MurimRun";
    // $cssFiles = [
    //     '/assets/css/style.css',
    //     '/assets/css/header.css'
    // ];
    
    function head($title, array $pageCss = []) 
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $title; ?></title>
            <?php
            if (!empty($pageCss)) {
                foreach ($pageCss as $cssFile) {
                    echo '<link rel="stylesheet" href="' . htmlspecialchars($cssFile) . '">' . PHP_EOL;
                }
            }
           ?>

           <style>
                main {
                    min-height: 100dvh;
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                }
           </style>

        </head>
            <body>
                <main>
                <?php } ?>
