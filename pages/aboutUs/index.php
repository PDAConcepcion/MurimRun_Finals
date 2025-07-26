<?php

$teamMember = [
    ['lastName' => 'Camino', 'firstName' => 'Gabriel Rabi Noel', 'course' => 'BSITDA'],
    ['lastName' => 'Concepcion', 'firstName' => 'Patrick Dhale', 'course' => 'BSITAGD'],
    ['lastName' => 'Putian', 'firstName' => 'Rey Vincent', 'course' => 'BSITAGD'],
    ['lastName' => 'Andres', 'firstName' => 'William Karl', 'course' => 'BSITAGD']


];

?>

<link rel="stylesheet" href="/assets/css/style.css">
<link rel="stylesheet" href="/pages/aboutUs/assets/css/about.css">


<div class="overlay">
</div>
<section class="page">
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