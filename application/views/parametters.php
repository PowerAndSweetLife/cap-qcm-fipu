<div id="show_hide" style="background-color: rgba(0,0,0,0.5);position: fixed;width:100%; height:100%;display:none;justify-content: center; align-items: center;z-index:3000;">
    <img src="<?php echo base_url(); ?>public/images/spinner.gif" alt="">
</div>
<div id="menu-slide" style="display: none ; width: 100% ; height: 100%; position: fixed; background-color: white ;z-index: 1000;">
    <div class="container">
        <ul class="navbar-nav" style="margin-top: 100px;">
            <li class="list-group-item" id="modalProgressionGlobaleID" data-bs-toggle="modal" data-bs-target="#modalProgressionGlobale"><span class="">Ma progression</span></li>
            <hr>
            <li class="nav-item">
                <a class="nav-link" href="#" style="" data-bs-toggle="modal" data-bs-target="#modalAide">Aide</span></a>
            </li>
            <hr>
            <li class="list-group-item"><i class="fa-solid fa-power-off text-danger"></i> <a href="<?php echo base_url(); ?>AllControllers/deconnect" style="text-decoration:none;" class="text-muted">Déconnexion</a></li>
        </ul>
    </div>
</div>

<nav class="navbar navbar-expand-lg bg-light shadow-sm fixed-top" style="height: 70px;">
    <div class="container">
        <a class="navbar-brand" href="<?php echo base_url(); ?>" style="font-weight: bold;font-size:25px">CAP-QCM</a>
        <ul class="navbar-nav ml-auto" style="position: relative;" id="menu-navbar">

            <div id="profil" etat="off" style="width:50px; height: 50px; border-radius: 50%; border: 2px solid green ;background-image: url('../public/images/utilisateur.png');background-position: center; background-repeat: no-repeat; background-size:cover ;">

            </div>
            <div id="profil-menu" style="width: 200px; height: 200px; background-color: white;border-radius: 10px ; position: absolute;top:50px;right:5px;z-index:1092" class="shadow border p-2">
                <h5 style="font-weight: bold;" class="text-center"><?php echo $_SESSION["pseudo"]; ?></h5>
                <ul class="list-group">
                    <!-- <li class="list-group-item"><i class="fa-regular fa-user"></i> <span>Profil</span></li> -->
                    <li class="list-group-item" id="modalProgressionGlobaleID" data-bs-toggle="modal" data-bs-target="#modalProgressionGlobale"><i class="fa-solid fa-check"></i> <span class="">Ma progression</span></li>
                    <li class="list-group-item d-none" data-bs-toggle="modal" data-bs-target="#modalParticiper" id="contribute"><i class="fa-solid fa-people-group"></i> <span class="">Contribuer</span></li>
                    <!-- <li class="list-group-item"><i class="fa-solid fa-question" style="margin-left: 7px;"></i> <span class=""> Aide</span></li> -->
                    <li class="list-group-item"><i class="fa-solid fa-power-off text-danger"></i> <a href="<?php echo base_url(); ?>AllControllers/deconnect" style="text-decoration:none;" class="text-muted">Déconnexion</a></li>
                </ul>
            </div>
            <li class="nav-item">
                <a class="nav-link" href="#" style="padding-left: 15px;padding-top: 12px;" data-bs-toggle="modal" data-bs-target="#modalAide">Aide</span></a>
            </li>
        </ul>
        <a style="display: none ;" id="bars-menu" href="#" class="text-muted"><i id="bars-menu-icon" class="fas fa-bars" style="font-size: 30px ;"></i></a>
        <a style="display: none ;" id="bars-menu-close" href="#" class="text-muted"><i id="bars-menu-close-icon" class="fas fa-times" id="" style="font-size: 30px ;"></i></a>
    </div>
</nav>
<div class="d-none" id="data_evolution" data-totalsession="<?php echo $session_total; ?>" data-datasession='<?php echo $session ?>'></div>

<span id="parametters" data-categorie="" data-mode="" data-section="" data-retardateur="" data-chrono="" data-note="" data-bonneReponse="" data-mauvaiseReponse="" data-absenceReponse="" data-temps=""></span>
<div class="container-fluid" style="padding-top: 100px;">
    <div class="container">
        <div class="row mt-4">
            <!-- <div class="d-flex justify-content-center">
            <img src="<?php echo base_url(); ?>public/images/logo.png" style="width: 200px" alt="">
        </div> -->
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-12"></div>
            <div class="col-md-4 shadow mt-3 border p-3 col-sm-12">
                <!-- <form action="" class="form-group" id> -->
                <?php echo form_open('AllControllers/begin'); ?>
                <label for="" style="font-weight: bold;">Categories</label>
                <select name="categorie" id="categorie" class="form-select my-2">
                    <option value="agent-fipu">Agent Finances publiques</option>
                    <option value="c-fipu">Contrôleur Finances publiques</option>

                </select>
                <input type="hidden" name="section" value="Français">
                <label for="" style="font-weight: bold;">Modes</label>
                <select id="mode" name="mode" class="form-select my-2">
                    <option value="entrainement">Entrainement</option>
                    <!-- <option value="contribuer">Contribuer</option> -->
                    <option value="code">Insérer un code de session</option>
                    <option value="revision">Révision</option>
                </select>


                <label for="code" class="code" style="font-weight: bold;">Code de la session</label>
                <input type="text" id="code" class="form-control my-2 code" name="code" placeholder="Code de la session">
                <br>
                <a href="#" id="verify_code" class="btn btn-outline-secondary d-none">Vérifier le code <i class="fa-solid fa-check"></i></a>
                <a href="#" id="btnContinuer" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalParamettres">Continuer <i class="fa-solid fa-arrow-right"></i></a>
                <a href="<?php echo base_url() ?>AllControllers/revision/agent-fipu" id="revision" class="btn btn-outline-primary d-none">Démarrer <i class="fa-solid fa-arrow-right"></i></a>
                <div class="modal fade" id="modalParamettres">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">PARAMETRES</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body p-3">
                                <!-- <div class="row border p-3 mb-3">
                                    <div class="col-md-8">
                                    Définir un temps
                                    </div>
                                    <div class="col-md-4">
                                        <input type="time" name="executionTime" class="form-control">
                                    </div>
                                </div> -->
                                <input value="01:30" type="time" name="executionTime" class="d-none">
                                <div class="row border p-3 mb-3">
                                    <div class="col-md-12">
                                        <label for="" style="font-weight: bold;">Afficher temps</label>
                                        <div class="mt-1 ml-2">
                                            <input type="radio" name="temps" value="chronometre" checked> Chronomètre <br>
                                            <input type="radio" name="temps" value="minuteur"> Minuteur
                                        </div>

                                    </div>
                                </div>
                                <div class="row border p-3 mb-3">
                                    <div class="col-md-12">
                                        <label for="" style="font-weight: bold;">Attribuer une note aux réponses</label>
                                        <div class="mt-1 ml-2">
                                            <input class="noteReponse" type="radio" name="isNote" value="oui" checked> Oui <br>
                                            <input class="noteReponse" type="radio" name="isNote" value="non"> Non
                                        </div>
                                        <div class="mt-3 toHide">
                                            <div class="row mb-2">
                                                <div class="col-md-6 col-sm-12">
                                                    Bonne réponse
                                                </div>
                                                <div class="col-md-3 col-sm-12">
                                                    <input type="number" class="form-control to-reform" step="any" style="position: relative; top: -10px" value="0" name="bonneReponse">
                                                </div>
                                                <div class="col-md-2 col-sm-12">
                                                    point(s)
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-6 col-sm-12">
                                                    Mauvaise réponse
                                                </div>
                                                <div class="col-md-3 col-sm-12">
                                                    <input type="number" class="form-control to-reform" step="any" style="position: relative; top: -10px" value="0" name="mauvaiseReponse">
                                                </div>
                                                <div class="col-md-2 col-sm-12">
                                                    point(s)
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-6 col-sm-12">
                                                    Absence de réponse
                                                </div>
                                                <div class="col-md-3 col-sm-12">
                                                    <input type="number" class="form-control to-reform" step="any" style="position: relative; top: -10px" value="0" name="absenceReponse">
                                                </div>
                                                <div class="col-md-2 col-sm-12">
                                                    point(s)
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary" id="demarrer_anim">Démarrer</button>

                            </div>

                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="col-md-4 col-sm-12"></div>
        </div>
    </div>
</div>

<div id="app" class="d-none"></div>


<div class="modal fade" id="modalParticiper">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Contribution</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <?php echo form_open('AllControllers/contribute', array('style' => "height: 300px;overflow-y:auto ;")); ?>
                <label for="">Catégorie</label>
                <!-- <textarea class="form-control mb-2"></textarea> -->
                <select name="categorie" id="" class="form-select mb-2">
                    <option value="Culture administrative et juridique">Culture administrative et juridique</option>
                    <option value="Finances publiques">Finances publiques</option>
                    <option value="Les institutions européennes">Les institutions européennes</option>
                    <option value="Culture numérique">Culture numérique</option>
                </select>
                <label for="">Question</label>
                <textarea name="question" class="form-control mb-2"></textarea>
                <label for="">Réponse 1: <span style="font-weight: bold;">Entrer réponse correct ici</span></label>
                <textarea name="reponse_1" class="form-control mb-2"></textarea>
                <label for="">Réponse 2</label>
                <textarea name="reponse_2" class="form-control mb-2"></textarea>
                <label for="">Réponse 3</label>
                <textarea name="reponse_3" class="form-control mb-2"></textarea>

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
                <p>Le mode entraînement permet de vous exercer sur une session de qcm de 54 questions très variées dans un délai de 90 min (condition de concours). Lors du mode entraînement, vous pourrez choisir d’attribuer des points positifs aux bonnes réponses et négatifs aux mauvaises, ou ne pas du tout attribuer de points à vos différentes réponses.</p>


                <!-- <p>Le mode contribution vous permet d’enrichir la base de données de l’application avec des questions / réponses que vous intégrerez vous-même. Celles-ci seront automatiquement ajoutées dans les QCM générés dans le mode entraînement.</p> -->


                <p>Le mode insérer un code de session vous permet de rejouer un QCM que vous avez déjà effectué afin de vous réévaluer.
                    Vous pouvez également récupérer un code de session ou communiquer un code de session à un ami afin de le défier (dans un esprit ludique bien évidemment).
                    Les codes de session sont affichés et sont à récupérer à la fin d’une session entraînement.</p>

                <p>Le mode révision permet de revoir spécifiquement des questions que vous auriez ajoutées dans vos favoris. </p>
                <!-- <p>Il s’agit de questions sur lesquelles vous avez également ajouté vos notes personnelles.</p> -->

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="modalProgressionGlobale">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div id="the_evolution_globale" class="w-100" style="height: 600px;">

                </div>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="fermerProgressionGlobale">Fermer</button>
            </div>

        </div>
    </div>
</div>