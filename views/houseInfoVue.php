<?php
include("template/header.php"); ?>
<?php 
if (!isset($_SESSION['nocookies'])) {
    if (!isset($_COOKIE['acceptation'])) {
        require("../views/cookiesVue.php");
} else {
    $_SESSION['nocookies'] = 'true';
}
} ?>

<?php foreach ($houseByToken[0] as $houseInfo) { ?>
<h1 style="margin-top: 100px !important;" class="mb-4 text-center"> <?= $houseInfo->getTitle() ?></h1>
<div class="row col-12 col-lg-10 mx-auto m-0 p-0">
    <div class="col-lg-7 col-md-10 col-12 m-0 p-0 m-0 p-0">
        <div id="carouselExampleControls" class="carousel slide col-12 m-0 p-0 height250 mx-auto" data-ride="carousel">
            <div class="carousel-inner" id="createImgDiv">
                <?php 
                foreach ($houseByToken[1] as $imageInfo) {
                    $allImages = $imageInfo->getLink();
                    $explose = explode(" ", $allImages);
                    $toJson = json_encode($explose);
                }
                $exploseCount = count($explose);
                ?>
            </div>
            <?php if ($exploseCount > 2) { ?>
            <a class="height250 carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span style="color: black;" class="roundedbg" aria-hidden="true"><i class="fa-2x fas fa-chevron-circle-left"></i></span>
                <span class="sr-only">Avant</span>
            </a>
            <a class="height250 carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span style="color: black;" class="roundedbg" aria-hidden="true"><i class="fa-2x fas fa-chevron-circle-right"></i></span>
                <span class="sr-only">Prochain</span>
            </a>
            <?php } ?>
        </div>
        <div class="col-12 row mt-3">
            <div class="row d-flex col-12 col ml-2">
                <p class="pr-2 my-auto text-center"><span class="font-weight-bold">Pièce</span>: <span class="colororange font-weight-bold"><?= $houseInfo->getRooms() ?></span></p>
                <p class="pr-2 my-auto"><span class="font-weight-bold">Chambres</span>: <span class="colororange font-weight-bold"><?= $houseInfo->getBedroom() ?></span></p>
                <p class="my-auto"><span class="font-weight-bold">Surface</span>: <span class="colororange font-weight-bold"><?= $houseInfo->getArea() ?> m²</span></p>
            </div>
            <div class="col-12">
                <h2 class="price font-weight-bold text-right"><?= substr(number_format($houseInfo->getPrice(), 2, ',', ' '), 0, -3) ?> €</h2>
            </div>
            <div class="col-12">
                <p class="text-right">Ref: <?= $houseInfo->getTokenAppartments(); ?></p>
            </div>
            <?php if (isset($_SESSION['idUser'])) {
                if ($_SESSION['idUser'] == $houseInfo->getUserId() or $_SESSION['role'] == 'is_admin') { ?>
            <div class="col-12 m-0 p-0 text-right">
                <form action="updateHouse.php?houseIdentification=<?= $houseInfo->getTokenAppartments() ?>" method="post">
                    <input type="button" onclick="dflexmodal()" class="btn btn-danger" value="Supprimer">
                    <input type="submit" class="text-white btn btn-warning" value="Editer">
                </form>
                <div class="d-none alert alert-primary mt-2" id="modal">
                    <p class="text-left">Souhaitez vous réellement supprimer <span class="colorred font-weight-bold">"<?= $houseInfo->getTitle(); ?></span>" ?</p>
                    <form action="" method="post">
                        <?php for ($i=1; $i < $exploseCount; $i++) { ?> 
                        <input type="hidden" name="image<?= $i ?>" value="<?= $explose[$i]?>">
                        <?php }?>
                        <input type="hidden" name="imageId" value="<?= $houseInfo->getImagesId() ?>">
                        <input type="hidden" name="houseIdentification" value="<?= $houseInfo->getTokenAppartments() ?>">
                        <input class="btn btn-danger" name="removeHouse" type="submit" value="Supprimer">
                        <input class="btn btn-info" type="submit" value="Annuler">
                    </form>
                </div>
            </div>
                <?php 
                }
            } ?>
        </div>

        <hr>

        <div class="col-12">
            <div>
                <h3 class="font-weight-bold">DESCRIPTION</h3>
                <div class="littlehr"></div>
                <p><?= nl2br($houseInfo->getDescription()) ?></p>
            </div>
            <div>
                <h3 class="font-weight-bold">LOCALISATION</h3>
                <div class="littlehr"></div>
                <?php foreach ($houseByToken[2] as $departments) { ?>
                    <p><?= $houseInfo->getCity() ?>, <?= $departments->getDepartmentsName() ?></p>
                <?php } ?>
            </div>
            <div>
                <h3 class="font-weight-bold">ORIENTATION</h3>
                <div class="littlehr"></div>
                <p><?= $houseInfo->getOrientation() ?></p>
            </div>
            <div>
                <h3 class="font-weight-bold">GÉNÉRAL</h3>
                <div class="littlehr"></div>
                <p>Pièce: <?= $houseInfo->getRooms() ?></p>
                <p>Chambres: <?= $houseInfo->getBedroom() ?></p>
                <p>Salle de bain: <?= $houseInfo->getBathroom() ?></p>
                <p>Surface: <?= $houseInfo->getArea() ?>m²</p>
            </div>
            <div>
                <h3 class="font-weight-bold">PRIX</h3>
                <div class="littlehr"></div>
                <p><?= $houseInfo->getPrice() ?> Honoraires TTC inclus à la charge de l'acquéreur : <span class="colororange font-weight-bold">5 %</span> du prix du bien hors honoraires.</p>
                <?php $calculPrice = $houseInfo->getPrice() * 0.95 ?>
                <p>Prix du bien hors honoraires : <span class="font-weight-bold colororange"><?= substr(number_format($calculPrice, 2, ',', ' '), 0, -3) ?> €</span></p>
            </div>
        </div>

    </div>
    <?php } ?>
    <div class="col-lg-5 col-md-10 col-12 mx-auto m-0 p-0">
        <div class="col-md-11 col-12 mx-auto">
            <div class="card">
                <article class="card-body">
                    <?php foreach ($houseByToken[3] as $user) { ?>
                    <h4 class="card-title text-center mb-4 mt-1">Contacter <a href="detailUser.php?idUserProfil=<?= $user->getIdUser() ?>"><?= $user->getFirstname() . ' ' . $user->getLastname() ?></a></h4>
                    <?php } ?>
                    <hr>
                    <?php if(!isset($_SESSION['mail'])){
                        require('../views/connexionVue.php');
                    } else { ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fas fa-envelope"></i> </span>
                                </div>
                                <input name="" class="form-control" value="<?= $_SESSION['mail'] ?>" type="email" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label class="w-100" for="text">Message:</label>
                                <textarea name="" id="text" class="form-control" placeholder="..." rows="5"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn orangebg text-white btn-block"> Envoyer  </button>
                        </div>
                    </form>
                    <?php } ?>
                </article>
            </div>
        </div>
    </div>

</div>

<?php
include("template/footer.php"); ?>

<script>
    let jsonTable = '<?php echo $toJson ?>';
    houseInfoCreateCarousel(jsonTable);
</script>