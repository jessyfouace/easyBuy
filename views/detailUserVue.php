<?php
include("template/header.php"); ?>

<div style="margin-top: 100px;">
    <div class="container">
        <div class="row my-2">
            <div class="col-lg-8 order-lg-2 mx-auto">
                <p class="colorgreen sizeh2 text-center font-weight-bold"><?= $messageOk ?></p>
                <p class="colorred sizeh2 text-center font-weight-bold"><?= $messageNo ?></p>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Profil</a>
                    </li>
                    <?php if (isset($_SESSION['idUser'])) {
                        if ($_SESSION['idUser'] == $_GET['idUserProfil']) { ?>
                    <li class="nav-item">
                        <a href="" data-target="#messages" data-toggle="tab" class="nav-link">Messages</a>
                    </li>
                    <li class="nav-item">
                        <a href="" data-target="#edit" data-toggle="tab" class="nav-link">Modifier</a>
                    </li>
                    <?php }
                    } ?>
                    <?php if (isset($_SESSION['idUser'])) {
                        if ($_SESSION['idUser'] !== $_GET['idUserProfil']) { ?>
                    <li class="nav-item">
                        <a href="" data-target="#contactUser" data-toggle="tab" class="nav-link">Contacter</a>
                    </li>
                    <?php }
                    } ?>
                </ul>
                <div class="tab-content py-4">
                    <div class="tab-pane active" id="profile">
                    <?php foreach ($infoUser[0] as $user) { ?>
                        <h1 class="sizeh2 mb-3"><?= $user->getFirstname() . ' ' . $user->getLastname() ?></h1>
                        <div class="row">
                            <div class="col-md-6">
                                <h2 class="sizeh2 font-weight-bold">Rôle</h2>
                                <?php if ($user->getRole() == 'is_admin') { ?>
                                    <p>Administrateur</p>
                                <?php } else { ?>
                                    <p>Utilisateur</p>
                                <?php } ?>
                                <h2 class="sizeh2 font-weight-bold">Contacter</h2>
                                <p><?= $user->getMail() ?></p>

                            </div>
                            <div class="col-md-12">
                                <h5 class="mt-2"><span class="font-weight-bold"> Ajouts récent</span></h5>
                                <table class="table table-sm table-hover table-striped">
                                    <tbody>    
                                    <?php foreach ($infoUser[1] as $house) { ?>                                
                                        <tr>
                                            <td>
                                                <a href="houseInfo?houseIdentification=<?= $house->getTokenAppartments() ?>"><?= $house->getTitle(); ?></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="nohover">
                                                <p class="price font-weight-bold"><?= number_format($house->getPrice(), 2, ',', ' ') ?> €</p>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="tab-pane" id="messages">
                        <div class="alert alert-info alert-dismissable">
                            <a class="panel-close close" data-dismiss="alert">×</a> This is an <strong>.alert</strong>. Use this to show important messages to the user.
                        </div>
                        <table class="table table-hover table-striped">
                            <tbody>                                    
                                <tr>
                                    <td>
                                    <span class="float-right font-weight-bold">3 hrs ago</span> Here is your a link to the latest summary report from the..
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <span class="float-right font-weight-bold">Yesterday</span> There has been a request on your account since that was..
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <span class="float-right font-weight-bold">9/10</span> Porttitor vitae ultrices quis, dapibus id dolor. Morbi venenatis lacinia rhoncus. 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <span class="float-right font-weight-bold">9/4</span> Vestibulum tincidunt ullamcorper eros eget luctus. 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <span class="float-right font-weight-bold">9/4</span> Maxamillion ais the fix for tibulum tincidunt ullamcorper eros. 
                                    </td>
                                </tr>
                            </tbody> 
                        </table>
                    </div>
                    <?php if (isset($_SESSION['idUser'])) {
                        if ($_SESSION['idUser'] == $_GET['idUserProfil']) { ?>
                    <div class="tab-pane" id="edit">
                        <form role="form" method="post">
                            <?php foreach ($infoUser[0] as $user) { ?>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Prénom</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="firstname" value="<?= $user->getFirstname() ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Nom</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" name="lastname" value="<?= $user->getLastname() ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="email" name="mail" value="<?= $user->getMail() ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Ancien mot de passe</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="password" name="lastpassword" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Nouveau mot de passe</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="password" name="newpassword" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Confirmation mot de passe</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="password" name="confirmnewpassword" value="">
                                </div>
                            </div>
                            <?php } ?>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-9">
                                    <input type="reset" class="btn btn-secondary" value="Annuler">
                                    <input type="submit" class="btn btn-primary" name="edit" value="Sauvegarder">
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include("template/footer.php"); ?>