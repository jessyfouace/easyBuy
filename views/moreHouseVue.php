<?php require('../views/template/header.php'); ?>
<?php 
if (!isset($_SESSION['nocookies'])) {
    if (!isset($_COOKIE['acceptation'])) {
        require("../views/cookiesVue.php");
    } else {
        $_SESSION['nocookies'] = 'true';
    }
}
foreach ($returnMessage as $house) { ?>
    <?= $house->getTitle(); ?>
<?php } ?>

<?php 
echo '<p align="center">Page : ';
for ($i = 1; $i <= $numberOfPage; $i++) {
    if ($i == $actualPage) {
        echo ' [ ' . $i . ' ] ';
    } else {
        echo ' <a href="moreHouse.php?page=' . $i . '">' . $i . '</a> ';
    }
}
echo '</p>';

require('../views/template/footer.php'); ?>
