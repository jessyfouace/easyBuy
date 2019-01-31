<?php require('../views/template/header.php'); ?>
<?php 
if (!isset($_SESSION['nocookies'])) {
    if (!isset($_COOKIE['acceptation'])) {
        require("../views/cookiesVue.php");
    } else {
        $_SESSION['nocookies'] = 'true';
    }
} ?> 
<div class="col-12 m-0 p-0" style="background-color: #eceff1">
    <div style="margin-top: 70px;">
        <p class="pt-5 colorred sizeh2 text-center font-weight-bold"><?= $errorMessage; ?></p>
    </div>
    <div class="col-lg-10 row mx-auto pt-4 mt-4">
        <div class="col-12 col-lg-2 col-lg-3 pb-5">
            <form class="bg-white w-100 pt-2 pl-2 pr-2" action="" method="get">
                <h1 class="text-center">Trier</h1>
                <p class="pb-0">Département:</p>
                <input type="hidden" name="page" value="1">
                <div class="form-group">
                    <select class="form-control" name="departments" id="" required>
                        <option value="" selected hidden>Département</option>
                        <?php foreach ($allDepartments as $departments) { ?>
                            <option value="<?= $departments->getDepartmentsName() ?>"><?= $departments->getDepartmentsName() ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="minprice">Prix Min: </label>
                    <input type="number" class="form-control" name="" min="80000" max="2000000" placeholder="100000" id="minprice">
                </div>
                <div class="form-group">
                    <label for="maxprice">Prix Max: </label>
                    <input type="number" name="" class="form-control" id="maxprice" min="80000" placeholder="200000" max="2000000">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-block" value="Filtrer">
                </div>
                <a href="moreHouse.php?page=1" class="btn btn-danger btn-block">Annuler</a>
            </form>
        </div>
        <div class="col-12 col-lg-9 mx-auto">
    <?php 
    $numberWhile = 0;
    foreach ($returnMessage[0] as $house) { 
    $numberWhile++;
    ?>
        <a href="houseInfo.php?houseIdentification=<?= $house->getTokenAppartments(); ?>" class="col-12 m-0 p-0" style="border-radius: 10px">
            <div class="row col-12 m-0 p-0 bg-white mb-5">
                <div class="col-sm-5 col-12 m-0 p-0">
                    <img id="images<?= $numberWhile ?>" style="width: 100%; height: 190px; border-radius: 5px" src="../assets/houseImg/maison1.png" alt="">
                    <?php
                        foreach ($returnMessage[1] as $imageInfo) {
                            if ($house->getImagesId() == $imageInfo->getIdImages()) {
                                $allImages = $imageInfo->getLink();
                                $explose = explode(" ", $allImages);
                                $toJson = json_encode($explose);
                            }
                        }
                    ?>
                </div>
                <script>
                    tableJson = '<?php echo $toJson ?>';
                    imagesId = 'images' + '<?php echo $numberWhile ?>';
                    exploseImage(tableJson, imagesId);
                </script>
                <div class="col-7">
                    <p class="pt-2"><?= substr(ucfirst($house->getTitle()), 0, 75) ?>..</p>
                    <p class="card-text street"><i class="fas fa-map-marker-alt"></i> <?= $house->getCity(); ?></p>
                    <h1 class="sizeh2 price font-weight-bold"><?= number_format($house->getPrice(), 2, ',', ' ') ?>€</h1>
                    <hr>
                    <p><span><i class="fas fa-bath"></i> <?= $house->getBathroom(); ?> sdb </span><span><i class="fas fa-bed"></i> <?= $house->getBedroom(); ?>ch </span><span><i class="fab fa-laravel"></i> <?= $house->getArea(); ?>m²</span></p>
                </div>
            </div>
        </a>
    <?php } ?>
        </div>
    </div>
    <div class="text-center mb-0 pb-0">
        <?php
        if ($numberOfPage > 1) {
            echo '<p class="m-0">';
            $page = (int) $_GET['page'];
            $prev_Page = $page - 1;
            $next_Page = $page + 1;
            if ($prev_Page) {
                echo "&nbsp;<a href='moreHouse.php?page=$prev_Page'><i class='text-primary sizeh2 fas fa-chevron-circle-left'></i></a>&nbsp; ";
            }
            for ($i = 1; $i <= $numberOfPage; $i++) {
                if ($i != $page) {
                    echo "&nbsp;<a class='sizeh2' href='moreHouse.php?page=$i'>$i</a>&nbsp; ";
                } else {
                    echo "&nbsp;<span class='sizeh2 colororange font-weight-bold'>$i</span>&nbsp; ";
                }
            }
            if ($page != $numberOfPage) {
                echo "&nbsp;<a href='moreHouse?page=$next_Page'><i class='text-primary sizeh2 fas fa-chevron-circle-right'></i></a>&nbsp;";
            }
            echo '</p>';
        }
        ?>
    </div>
</div>

<?php
require('../views/template/footer.php'); ?>