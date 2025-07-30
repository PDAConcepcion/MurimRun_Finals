<?php
require_once LAYOUTS_PATH . '/main.layout.php';

$teamMember = [
    [
        'lastName' => 'Putian',
        'firstName' => 'Rey Vincent',
        'course' => 'BSITAGD',
        'role' => 'Database Manager',
        'image' => '../../assets/img/members/murim-mem1.jpg'
    ],
    [
        'lastName' => 'Concepcion',
        'firstName' => 'Patrick Dhale',
        'course' => 'BSITAGD',
        'role' => 'Back-End',
        'image' => '../../assets/img/members/murim-mem2.jpg'
    ],
    [
        'lastName' => 'Camino',
        'firstName' => 'Gabriel Rabi Noel',
        'course' => 'BSITDA',
        'role' => 'Front-End',
        'image' => '../../assets/img/members/murim-mem3.jpg'
    ],
    [
        'lastName' => 'Andres',
        'firstName' => 'William Karl',
        'course' => 'BSITAGD',
        'role' => 'Front-End',
        'image' => '../../assets/img/members/murim-mem4.jpg'
    ],
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
    <section class="page members">
        <h1>Team Members</h1>
        <div class="member-section">
            <?php
            foreach ($teamMember as $member):
                ?>

                <div class="memberContainer">
                    <div class="memberPhoto">
                        <img src="<?php echo htmlspecialchars($member['image']); ?>"
                            alt="<?php echo htmlspecialchars($member['firstName'] . ' ' . $member['lastName']); ?>"
                            class="member-img">
                    </div>

                    <div class="member-info">

                        <p class="lastname"><?php echo htmlspecialchars($member['role']); ?></p>
                        <p class="firstname"><?php echo htmlspecialchars($member['lastName'] . ', ' . $member['firstName']); ?>
                        </p>
                        <p class="course"><?php echo htmlspecialchars($member['course']); ?></p>
                    </div>
                </div>

                <?php
            endforeach
            ?>
        </div>
    </section>
<?php }, 'About Us', ['css' => $pageCss]);