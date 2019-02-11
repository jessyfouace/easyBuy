<?php require('../views/template/header.php') ?>

<div style="margin-top: 90px;" class="container-fluid" id="wrapper">
    <div class="row">
        <nav class="sidebar col-xs-12 col-sm-4 col-lg-3 col-xl-2">                                                
            <ul class="nav nav-pills flex-column sidebar-nav">
                <li class="nav-item"><a class="nav-link <?php if (!isset($_GET['repport']) and !isset($_GET['house']) and !isset($_GET['users'])) { ?> text-white orangebg <?php } ?>" href="admin.php"><em class="fa fa-dashboard"></em> Pannel<span class="sr-only">(current)</span></a></li>
                <li class="nav-item"><a class="nav-link <?php if (isset($_GET['repport']) and $_GET['repport'] == 'true') { ?> text-white orangebg <?php }?>" href="admin.php?repport=true"><em class="fa fa-calendar-o"></em> Plaintes</a></li>
                <li class="nav-item"><a class="nav-link <?php if (isset($_GET['house']) and $_GET['house'] == 'true') { ?> text-white orangebg <?php }?>" href="admin.php?house=true"><em class="fa fa-bar-chart"></em> Biens</a></li>
                <li class="nav-item"><a class="nav-link <?php if (isset($_GET['users']) and $_GET['users'] == 'true') { ?> text-white orangebg <?php }?>" href="admin.php?users=true"><em class="fa fa-hand-o-up"></em> Utilisateurs</a></li>
            </ul>
        </nav>
        <main class="col-xs-12 col-sm-8 col-lg-9 col-xl-10 pt-3 pl-4 ml-auto">
            <header class="page-header row justify-center">
                <div class="col-12" >
                    <h1 class="float-left text-center text-md-left">Pannel Administrateur</h1>
                </div>
            </header>
            <section class="row <?php if (isset($_GET['repport']) or isset($_GET['house']) or isset($_GET['users'])) { ?> d-none <?php } ?>">
                <div class="col-sm-12">
                    <section class="row">
                        <div class="col-md-12 col-lg-8">
                            <div class="card mb-4">
                                <div class="card-block">
                                    <h3 class="card-title">Ajouts récent</h3>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Nom</th>
                                                    <th>Identifiant</th>
                                                    <th>Prix</th>
                                                    <th>Vendeur</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($allHouse[0] as $houseInfo) { ?>
                                                <tr>
                                                    <td class="font-weight-bold"><a href="houseInfo.php?houseIdentification=<?= $houseInfo->getTokenAppartments(); ?>"><?= substr($houseInfo->getTitle(), 0 , 28); ?>..</a></td>
                                                    <td class="font-weight-bold"><?= $houseInfo->getTokenAppartments(); ?></td>
                                                    <td class="price font-weight-bold"><?= substr(number_format($houseInfo->getPrice(), 2, ',', '&nbsp;'), 0, -3) ?>&nbsp;€</td>
                                                        <?php foreach ($allHouse[1] as $userInfo) { 
                                                        if ($houseInfo->getUserId() == $userInfo->getIdUser()) {
                                                        ?>
                                                    <td class="colororange font-weight-bold"><a href="detailUser.php?idUserProfil=<?= $userInfo->getIdUser() ?>"><?= $userInfo->getFirstname() . '&nbsp;' . $userInfo->getLastname() ?></a></td>
                                                        <?php
                                                        break;
                                                        } 
                                                    } ?> 
                                                </tr>
                                                <?php }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="card mb-4">
                                <div class="card-block">
                                    <h3 class="card-title">Derniers inscrit</h3>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tbody>
                                                <?php foreach ($allUsers as $user) { ?>
                                                <tr>
                                                    <td class="font-weight-bold"><a href="detailUser.php?idUserProfil=<?= $user->getIdUser() ?>"><?= $user->getFirstname() . ' ' . $user->getLastname(); ?></a></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </section>

            <section class="<?php if (!isset($_GET['repport']) and $_GET['repport'] != 'true') { ?> d-none <?php }?>">

            </section>

            <section class="<?php if (!isset($_GET['house']) and $_GET['house'] != 'true') { ?> d-none <?php }?>">
                <div class="col-md-12 col-lg-8">
                    <div class="card mb-4">
                        <div class="card-block">
                            <?php foreach ($countHouse as $toString) { ?>
                            <h3 class="card-title"><?= $toString ?> Biens</h3>
                            <?php } ?>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Identifiant</th>
                                            <th>Prix</th>
                                            <th>Vendeur</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($allHouse[0] as $houseInfo) { ?>
                                        <tr>
                                            <td class="font-weight-bold"><a href="houseInfo.php?houseIdentification=<?= $houseInfo->getTokenAppartments(); ?>"><?= substr($houseInfo->getTitle(), 0, 28); ?>..</a></td>
                                            <td class="font-weight-bold"><?= $houseInfo->getTokenAppartments(); ?></td>
                                            <td class="price font-weight-bold"><?= substr(number_format($houseInfo->getPrice(), 2, ',', '&nbsp;'), 0, -3) ?>&nbsp;€</td>
                                                <?php foreach ($allHouse[1] as $userInfo) {
                                                    if ($houseInfo->getUserId() == $userInfo->getIdUser()) {
                                                        ?>
                                            <td class="colororange font-weight-bold"><a href="detailUser.php?idUserProfil=<?= $userInfo->getIdUser() ?>"><?= $userInfo->getFirstname() . '&nbsp;' . $userInfo->getLastname() ?></a></td>
                                                <?php
                                                break;
                                            }
                                        } ?> 
                                        </tr>
                                        <?php 
                                    } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="<?php if (!isset($_GET['users']) and $_GET['users'] != 'true') { ?> d-none <?php }?>">
                <div class="col-md-12 col-lg-8">
                    <div class="card mb-4">
                        <div class="card-block">
                            <?php foreach ($countUsers as $toString) { ?>
                            <h3 class="card-title"><?= $toString ?> Utilisateurs</h3>
                            <?php 
                        } ?>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Prénom</th>
                                            <th>Prix</th>
                                            <th>Mail</th>
                                            <th>Profil</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($allUsers as $userInfo) { ?>
                                        <tr>
                                            <td><?= $userInfo->getFirstname() ?></td>
                                            <td><?= $userInfo->getLastname() ?></td>
                                            <td><?= $userInfo->getMail() ?></td>
                                            <td><a class="btn btn-info" href="detailUser.php?idUserProfil=<?= $userInfo->getIdUser() ?>">Profil</a></td>
                                        </tr>
                                        <?php 
                                    } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</div>
<?php require('../views/template/footer.php') ?>