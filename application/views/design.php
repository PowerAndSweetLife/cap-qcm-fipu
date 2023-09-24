<body id="home-body">

    <!-- <div id="show_hide" style="background-color: rgba(0,0,0,0.5);position: fixed;width:100%; height:100%;display:flex;justify-content: center; align-items: center;z-index:3000;">
        <img src="<?php echo base_url(); ?>public/images/spinner.gif" alt="">
    </div> -->

    <div id="mask-body">

    </div>
    <div id="menu-slide" style="display: none ; width: 100% ; height: 100%; position: fixed; background-color: white ;z-index: 1000;">
        <div class="container">
            <ul class="navbar-nav" style="margin-top: 70px;">
                <a class="nav-link text-primary" target="_blank" href="https://web.facebook.com/groups/631855062044106">
                    <i class="fab fa-facebook-f fa-lg"></i> Facebook
                </a>
                <hr>
                <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modalNousContacter">Contact</a>
                <hr>
                <a class="nav-link" href="#" id="free_access">Libre accès</a>
                <hr>
                <!-- <a class="nav-link d-none" href="<?php echo base_url(); ?>AllControllers/free_access" id="click_for_free_access"></a> -->
                <?php echo form_open('AllControllers/free_access', array('class' => 'd-none')); ?>
                <input type="submit" id="click_for_free_access">
                </form>
                <?php echo form_open('AllControllers/free_access_c', array('class' => 'd-none')); ?>
                <input type="submit" id="click_for_free_access_c">
                </form>
                
                <!-- <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modalParticiper">Contribuer</a> -->
                <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modalConnexion">Se connecter</a>
                <hr>
                <a class="text-primary" style="text-decoration: none ;" id="inscription_btn" href="#" data-bs-toggle="modal" data-bs-target="#modalInscription"><i class="far fa-user ml-2 fa-lg"></i> S'inscrire</a>
                <hr>
                
                <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modalAide">Aide</a>
            </ul>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg bg-light fixed-top" style="height: 70px;">
        <div class="container">
            <a class="navbar-brand" href="#" style="font-weight: bold;font-size:25px">CAP-QCM</a>
            <ul class="navbar-nav ml-auto" id="menu-navbar">
                <a class="nav-link text-primary" target="_blank" href="https://web.facebook.com/groups/631855062044106"><i class="fab fa-facebook-f fa-lg"></i> Facebook</a>
                <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modalNousContacter">Contact</a>
                <a class="nav-link" href="#" id="free_access">Libre accès</a>
                
                <!-- <a class="nav-link d-none" href="<?php echo base_url(); ?>AllControllers/free_access" id="click_for_free_access"></a> -->
                <?php echo form_open('AllControllers/free_access', array('class' => 'd-none')); ?>
                <input type="submit" id="click_for_free_access">
                </form>
                <!-- <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modalParticiper">Contribuer</a> -->
                <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modalConnexion">Se connecter</a>
                <a class="btn btn-outline-primary" id="inscription_btn" href="#" data-bs-toggle="modal" data-bs-target="#modalInscription"><i class="far fa-user ml-2 fa-lg"></i> S'inscrire</a>
                
                <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modalAide">Aide</a>
                
            </ul>
            <a style="display: none ;" id="bars-menu" href="#" class="text-muted"><i id="bars-menu-icon" class="fas fa-bars" style="font-size: 30px ;"></i></a>
            <a style="display: none ;" id="bars-menu-close" href="#" class="text-muted"><i id="bars-menu-close-icon" class="fas fa-times" id="" style="font-size: 30px ;"></i></a>
        </div>
    </nav>

    <div class="d-flex justify-content-center align-items-center">
        <div class="border p-5 d-none" id="design-disclaimer" style="width: 500px; min-height: 400px ;  background-color: white ; position: absolute;z-index: 2000;top: 5%;">
            <p>
                Cap-qcm veille au respect de la protection des données de l'utilisateur et <strong>n'utilise aucun traceur</strong>.
            </p>
            <p>
                Pour votre inscription, <strong>n'utilisez aucune</strong> information vous concernant (nom, prénom, surnom, age, sexe, localisation...) et <strong>n'utilisez pas</strong> une adresse mail permettant de vous identifier (nom.prénom@nomdedomaine), <strong>ni une adresse mail personnelle habituelle, ni une adresse mail professionnelle</strong>.
            </p>
            <p>
                Un compte créé avec des informations qui permettraient de vous identifier sera clôturé.
            </p>
            <button class="btn btn-outline-primary" id="compris-ok">J'ai compris et je suis d'accord</button>
        </div>
        <div id="content-presentation">
            <div class="container" style="width: 100%;">
                <h1 style="font-weight: bold;" class="text-white text-center" id="cap-qcm">CONCOURS ADMINISTRATIF EN POCHE - QCM
                </h1>
                <h3 class="text-white text-center">CAP QCM est une application <span style="font-weight: bold ;">gratuite</span> pour réviser l'épreuve de QCM du concours commun de catégorie C et de celui de catégorie B des finances publiques. 
                </h3>
                <p class="text-white text-center">Application sans cookie sans publicité.</p>
                

            </div>
        </div>
    </div>

    <div class="fixed-footer bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center align-items-center">
                    <p style="font-size: 12px;" class="text-white">
                        * Information : la création d’un compte permet d’accéder à
                        l’intégralité des fonctionnalités de l’application et ne nécessite
                        qu’un pseudo et une adresse mail
                    </p>
                </div>
            </div>
        </div>
    </div>




    <!-- The Modal -->
    <div class="modal fade" id="modalInscription">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Inscription</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <?php echo form_open('AllControllers/register'); ?>
                    <label for="pseudo" class="form-label">Pseudo:</label>
                    <input type="text" class="form-control mb-2" id="pseudo" placeholder="Votre pseudo ici" name="pseudo" required>
                    <label for="email" class="form-label">E-mail:</label>
                    <input type="email" class="form-control mb-2" id="email" placeholder="Votre e-mail ici" name="email" required>
                    <!-- <p><a href="<?php echo base_url() ?>signin" style="text-decoration: none;font-size: 13px;font-weight: bold;">J'ai deja -->
                    <!-- un compte ? Se connecter</a></p> -->

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                    <input type="submit" value="S'inscrire" class="btn btn-primary">
                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- The Modal -->
    <div class="modal fade" id="modalAide">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Aide</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <p>Pour envoyer un message, utiliser l’onglet contact (pour faire des suggestions, pour proposer des améliorations et même pour apporter des corrections)</p>

                    <p>L’onglet libre accès vous permettra de vous exercer sur le qcm le plus récent proposé au concours sans avoir à vous inscrire ni à vous connecter.</p>

                    <p>Se connecter vous permettra d’accéder à des qcm variés et de suivre votre activité ainsi que votre progression.</p>

                    <p>S’inscrire vous permettra de créer gratuitement votre compte pour avoir accès à l’ensemble des fonctionnalités de l’application.</p>


                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
                </div>

            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="modalConnexion">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Connexion</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <?php echo form_open('AllControllers/connect'); ?>
                    <label for="email" class="form-label">E-mail:</label>
                    <input type="email" class="form-control mb-2" id="email" placeholder="Votre e-mail ici" name="email" required>
                    <!-- <p><a href="<?php echo base_url(); ?>signup" style="text-decoration: none;font-size: 13px;font-weight: bold;">Pas encore membre ? S'inscrire</a></p> -->


                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                    <input type="submit" value="Se connecter" class="btn btn-primary">
                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- The Modal -->
    <div class="modal fade" id="modalNousContacter">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Contact</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <?php echo form_open('AllControllers/send_email') ?>
                    <label for="email" class="form-label">E-mail:</label>
                    <input type="email" class="form-control mb-2" id="email" placeholder="Votre e-mail ici" name="email" required>
                    <label for="objet" class="form-label">Objet:</label>
                    <input type="text" class="form-control mb-2" id="objet" placeholder="Objet de votre message" name="objet" required>
                    <label for="message">Message:</label>
                    <textarea class="form-control mb-2" rows="5" id="message" name="text" placeholder="Contenu de votre message" required></textarea>


                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                    <input type="submit" value="Envoyer" class="btn btn-primary">
                    </form>
                </div>

            </div>
        </div>
    </div>