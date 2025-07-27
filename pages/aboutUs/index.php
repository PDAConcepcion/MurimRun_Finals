<?php
require_once LAYOUTS_PATH . '/main.layout.php';

$teamMember = [
    ['lastName' => 'Camino', 'firstName' => 'Gabriel Rabi Noel', 'course' => 'BSITDA'],
    ['lastName' => 'Concepcion', 'firstName' => 'Patrick Dhale', 'course' => 'BSITAGD'],
    ['lastName' => 'Putian', 'firstName' => 'Rey Vincent', 'course' => 'BSITAGD'],
    ['lastName' => 'Andres', 'firstName' => 'William Karl', 'course' => 'BSITAGD']
];

$pageCss = [
    '../../assets/css/header.css',
    '../../assets/css/footer.css',
    '../../assets/css/style.css',
    'assets/css/about.css'
];

renderMainLayout(function () use ($teamMember) { ?>
<div class="overlay">
</div>
<section class="page">
    <h1>Team Members</h1>
    <div class="member-section">
        <?php
        foreach ($teamMember as $member):
            ?>

            <div class="memberContainer">
                <div class="memberPhoto">

                </div>

                <div class="member-info">

                    <p class="lastname"><?php echo $member['lastName'] ?></p>
                    <p class="firstname"><?php echo $member['firstName'] ?></p>
                    <p class="course"><?php echo $member['course'] ?></p>
                </div>
            </div>

            <?php
        endforeach
        ?>
    </div>
</section>
<?php }, 'About Us', ['css' => $pageCss]);