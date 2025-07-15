<?php
    $title = "MurimRun";
    $cssFiles = [
        '/assets/css/style.css',
        '/assets/css/header.css'
    ];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>

    <?php foreach ($cssFiles as $cssFile): ?>
        <link rel="stylesheet" href="<?php echo $cssFile; ?>">
    <?php endforeach; ?>
</head>
