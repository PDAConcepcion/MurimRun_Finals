<?php
// Includes the header.
require_once __DIR__ . '/../../components/templates/header.component.php';

// --- DUMMY DATA ---
// In a real application, this array would be populated from your database.
$couriers = [
    [
        'id' => 1,
        'name' => 'Flash Express',
        'details' => 'Fast and reliable delivery service available nationwide. Operates 24/7.',
        'image' => '../../assets/img/nyebe_white.png' // Placeholder image
    ],
    [
        'id' => 2,
        'name' => 'LBC Express',
        'details' => 'Wide network coverage and trusted service for documents and parcels.',
        'image' => '../../assets/img/nyebe_white.png' // Placeholder image
    ],
    [
        'id' => 3,
        'name' => 'J&T Express',
        'details' => 'Known for its extensive reach, even in remote areas. Offers cash on delivery.',
        'image' => '../../assets/img/nyebe_white.png' // Placeholder image
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - MurimRun</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="assets/css/userPage.css">
</head>
<body>

    <main class="user-page">
        <div class="page-header">
            <h1>Available Couriers</h1>
            <a href="../accountPage/" class="btn btn-secondary">Edit Profile</a>
        </div>
        
        <div class="courier-list">
            <?php foreach ($couriers as $courier): ?>
                <div class="courier-card">
                    <img src="<?= htmlspecialchars($courier['image']) ?>" alt="<?= htmlspecialchars($courier['name']) ?> Logo" class="courier-logo">
                    <div class="courier-info">
                        <h3 class="courier-name"><?= htmlspecialchars($courier['name']) ?></h3>
                        <p class="courier-details"><?= htmlspecialchars($courier['details']) ?></p>
                    </div>
                    <button class="btn btn-primary select-courier-btn" data-courier-id="<?= $courier['id'] ?>">Select Courier</button>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <?php
    // Includes the footer.
    require_once __DIR__ . '/../../components/templates/footer.component.php';
    ?>
    <script src="assets/js/userPage.js"></script>
</body>
</html>