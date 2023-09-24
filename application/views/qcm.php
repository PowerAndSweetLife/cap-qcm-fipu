<?php const URL_ADMIN = "https://cap-qcm.com/admin/"; ?>



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

<span id="parametters" data-categorie="<?php echo $categorie; ?>" data-mode="<?php echo $mode; ?>" data-section="<?php echo $section; ?>" data-retardateur="<?php echo $retardateur; ?>" data-chrono="<?php echo $chrono; ?>" data-note="<?php echo $note; ?>" data-bonneReponse="<?php echo $bonneReponse ?>" data-mauvaiseReponse="<?php echo $mauvaiseReponse; ?>" data-absenceReponse="<?php echo $absenceReponse; ?>" data-temps="<?php echo $temps; ?>"></span>
<span class="d-none" data-timer="<?php echo $temps; ?>" id="timer"></span>
<div class="container-fluid" style="padding-top: 100px ;">
    <div class="container">
        <div class="row">
            <div class="col-md-3 p-3">
                <div class="accordion shadow" id="accordionExample">
                    <!-- <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Catégories
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse show collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body accordion-body-categorie">
                                <ul>
                                    <li>
                                        <a href="#" class="text-muted section-menu-categorie-anchor activated">Attaché d'administration</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Sections
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse show collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <ul>
                                    <?php for ($i = 0; $i < count($donnees_qcm); $i++) : ?>
                                        <li>
                                            <a href="#" data-section="<?php echo $donnees_qcm[$i]->section_nom; ?>" class="text-muted section-menu-anchor <?php if ($donnees_qcm[$i]->section_nom == $section) {
                                                                                                                                                                echo 'activated';
                                                                                                                                                            } ?>"><?php echo $donnees_qcm[$i]->section_nom; ?></a>
                                        </li>
                                    <?php endfor; ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Liste de questions
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <?php for ($d = 0; $d < count($donnees_qcm); $d++) : ?>
                                    <?php
                                    $afficheur = "d-none";

                                    if ($donnees_qcm[$d]->section_nom == $section) {
                                        $afficheur = "";
                                    }
                                    ?>
                                    <ul data-section="<?php echo $donnees_qcm[$d]->section_nom; ?>" class="<?php echo $afficheur; ?> qst_list" style="height: 300px; overflow-y: auto;scrollbar-width: thin;-webkit-scrollbar-width: thin; padding-left:0px ;">
                                        <?php for ($l = 0; $l < count($donnees_qcm[$d]->questions); $l++) : ?>
                                            <?php $questions_reponses = $donnees_qcm[$d]->questions; ?>
                                            <li style="font-size: 13px;font-weight:bold ;" class="mt-2">
                                                <a data-tracer="<?php echo $donnees_qcm[$d]->section_nom; ?>" href="#" data-id="<?php echo $questions_reponses[$l]->question_id; ?>" class="hover-menu-qst shortcut-qst" style="color: #212529;"><?php echo $l + 1; ?>. <?php echo $questions_reponses[$l]->question_text; ?></a>
                                            </li>
                                        <?php endfor; ?>
                                    </ul>
                                <?php endfor; ?>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php for ($all = 0; $all < count($donnees_qcm); $all++) : ?>
                <?php
                $hideSectionByJumper = "d-none";
                if ($donnees_qcm[$all]->section_nom == $section) {
                    $hideSectionByJumper = "";
                }

                ?>
                <div id="top-top" class="col-md-6 p-3 header-jumper-section <?php echo $hideSectionByJumper; ?>" data-section="<?php echo $donnees_qcm[$all]->section_nom; ?>">
                    <?php for ($i = 0; $i < count($donnees_qcm[$all]->questions); $i++) : ?>
                        <?php $questions_reponses = $donnees_qcm[$all]->questions; ?>
                        <?php

                        $toShow = "d-none";
                        if ($i == 0) {
                            $toShow = "";
                        }
                        ?>
                        <div data-section="<?php echo $donnees_qcm[$all]->section_id ?>" data-question="<?php echo $questions_reponses[$i]->question_id ; ?>" data-tracer="<?php echo $donnees_qcm[$all]->section_nom; ?>" class="card card-questions card-bringing-data shadow <?php echo $toShow ?> qst-ID-<?php echo $questions_reponses[$i]->question_id ?>  qst-<?php echo $i + 1 ?>" data-id="qst-<?php echo $i + 1 ?>">
                            <div class="card-header d-flex flex-row p-4" style="justify-content: space-between;background-color: white ;">
                                <h5 class="text-center" style="font-weight: bold ;"><?php echo $donnees_qcm[$all]->section_nom; ?> </h5>
                                <!-- <a href="#" class="text-danger" style="font-size: 20px;"><i class="fa-regular fa-heart heart"></i></a> -->
                            </div>
                            <div class="card-body" style="min-height: 400px;">
                                <div class="card-title">
                                    <?php if ($questions_reponses[$i]->question_text != "") : ?>
                                        <p style="font-weight: bold;"><?php echo $i + 1; ?>. <?php echo $questions_reponses[$i]->question_text; ?></p>
                                        <?php if ($questions_reponses[$i]->question_image != "") : ?>
                                            <img style="width: 100%;object-fit: contain;" src="<?php echo URL_ADMIN; ?>public/<?php echo $questions_reponses[$i]->question_image ?>" alt="">
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <img style="width: 100%;object-fit: contain;" src="<?php echo URL_ADMIN; ?>public/<?php echo $questions_reponses[$i]->question_image ?>" alt="">
                                    <?php endif; ?>

                                </div>
                                <ul class="list-reform-checkbox " data-remarque="" data-idreponse="" data-idquestion="<?php echo $questions_reponses[$i]->question_id; ?>">
                                    <?php for ($a = 0; $a < count($questions_reponses[$i]->reponses); $a++) : ?>
                                        <?php $reponse = $questions_reponses[$i]->reponses ?>
                                        <li>
                                            <?php if ($reponse[$a]->reponse_image != "") : ?>
                                                <input class="check-question check-question-<?php echo $questions_reponses[$i]->question_id; ?>" type="checkbox" data-etat="off" data-question="<?php echo $questions_reponses[$i]->question_id; ?>" data-remarque="<?php echo $reponse[$a]->reponse_remarque; ?>" data-idreponse="<?php echo $reponse[$a]->reponse_id; ?>">
                                                <img style="width: 75px;object-fit: contain;" src="<?php echo URL_ADMIN; ?>public/<?php echo $reponse[$a]->reponse_image ?>" alt="">
                                            <?php else : ?>
                                                <input class="check-question check-question-<?php echo $questions_reponses[$i]->question_id; ?>" type="checkbox" data-etat="off" data-question="<?php echo $questions_reponses[$i]->question_id; ?>" data-remarque="<?php echo $reponse[$a]->reponse_remarque; ?>" data-idreponse="<?php echo $reponse[$a]->reponse_id; ?>"> <span><?php echo $reponse[$a]->reponse_contenu ?></span>
                                            <?php endif; ?>

                                        </li>
                                    <?php endfor; ?>
                                </ul>
                            </div>
                            <div class="card-footer">
                                <p class="text-center p-3">
                                    <span><a href="#top-top" data-id="<?php echo $i ?>" class="btn btn-outline-primary page-prec" data-tracer="<?php echo $donnees_qcm[$all]->section_nom; ?>" style="text-decoration: none ; font-weight: bold;"><span class="text-prec">Question précédente</span><i class="fas fa-arrow-left arrow-left"></i></a></span>
                                    <span style="font-size: 20px; font-weight: bold;margin-left:10px" class="text-danger"><?php echo str_pad($i + 1, 2, "0", STR_PAD_LEFT) ?></span>
                                    <span style="font-size: 20px;">/</span>
                                    <span style="font-size: 20px; font-weight: bold;margin-right:10px"><?php echo count($donnees_qcm[$all]->questions); ?></span>
                                    <span><a href="#top-top" data-totale="<?php echo count($donnees_qcm[$all]->questions); ?>" data-id="<?php echo $i + 2 ?>" class="btn btn-outline-primary page-suiv" data-tracer="<?php echo $donnees_qcm[$all]->section_nom; ?>" style="text-decoration: none ; font-weight: bold;"><span class="text-suiv">Question suivante</span><i class="fas fa-arrow-right arrow-right"></i></a></a></span>
                                </p>

                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            <?php endfor; ?>
            <div class="col-md-3 p-3">
                <!-- <div id="app" class="d-flex justify-content-center"></div> -->
                <div class="d-flex justify-content-center">
                    <div style="width: 150px; height: 150px; border: 10px solid green; border-radius: 50% ; align-items: center ;" class="d-flex justify-content-center">
                        <span id="heure" style="font-size: 20px;">00</span>
                        <span style="font-size: 20px;">:</span>
                        <span id="minute" style="font-size: 20px;">00</span>
                        <span style="font-size: 20px;">:</span>
                        <span id="seconde" style="font-size: 20px;">00</span>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-center p-2">
                    <button class="btn btn-outline-danger" id="btn-terminate-initiator">Terminer la session</button>
                    <button class="d-none" id="btn-terminate" data-bs-toggle="modal" data-bs-target="#modaleResults">Terminer la session</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// var_dump($donnees_qcm) ;
$total_qst = 0;
for ($iqcm = 0; $iqcm < count($donnees_qcm); $iqcm++) {
    $total_qst += count($donnees_qcm[$iqcm]->questions);
}

?>


<!-- The Modal -->
<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" id="modaleResults">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Résultats</h4>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item py-3">
                        <div class="row">
                            <div class="col-md-10">
                                Nombre de questions répondues
                            </div>
                            <div class="col-md-2">
                                <span id="answered">0</span> / <?php echo $total_qst ?>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item py-3">
                        <div class="row">
                            <div class="col-md-10">
                                Nombre de questions non répondues
                            </div>
                            <div class="col-md-2">
                                <span id="notAnswered">0</span> / <?php echo $total_qst ?>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item py-3">

                        <div class="row">
                            <div class="col-md-10">
                                Nombre de réponses justes
                            </div>
                            <div class="col-md-2">
                                <span id="rightAnswer">0</span> / <?php echo $total_qst ?>
                            </div>
                        </div>

                    </li>
                    <li class="list-group-item py-3">

                        <div class="row">
                            <div class="col-md-10">
                                Nombre de réponses fausses
                            </div>
                            <div class="col-md-2">
                                <span id="wrongAnswer">0</span> / <?php echo $total_qst ?>
                            </div>
                        </div>

                    </li>
                </ul>
                <hr class="isNoteHideShow">
                <ul class="mt-2 list-group isNoteHideShow">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-10">
                                <span style="text-decoration: underline; font-weight: bold ;">Rappel de notation choisie:</span>
                            </div>
                            <div class="col-md-2">
                                <!-- <span>0</span> -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                Bonne réponse
                            </div>
                            <div class="col-md-2">
                                <!-- <span>0</span> -->
                                <span id="pointBonne"></span> point(s)
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                Mauvaise réponse
                            </div>
                            <div class="col-md-2">
                                <!-- <span>0</span> -->
                                <span id="pointMauvais"></span> point(s)
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                Absence de réponse
                            </div>
                            <div class="col-md-2">
                                <!-- <span>0</span> -->
                                <span id="pointAbsence"></span> point(s)
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-10">
                                <span style="font-size: 20px; font-weight: bold;">Note (Coefficient 2)</span>

                            </div>
                            <div class="col-md-2">
                                <!-- <span id="myNote">0</span><br>   -->
                                <span id="the_note" style="font-size: 20px; font-weight: bold;">0</span><span style="font-size: 20px; font-weight: bold;">/20</span>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item" id="showIfEliminatoire">
                        <p class="text-center text-danger" style="font-weight: bold ;">NOTE ELIMINATOIRE</p>
                    </li>
                </ul>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer flex-column">
                <!-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> -->

                <!-- <div> -->
                <button type="button" class="btn btn-outline-primary w-100" id="code_session">Générer code de la session pour partager ou rejouer plus tard</button>
                <!-- </div> -->
                <!-- <div> -->
                <a href="#" class="btn btn-outline-secondary w-100" id="getEvolution" data-bs-toggle="modal" data-bs-target="#modalProgression">Ma progression</a>
                <a href="#" class="btn btn-outline-success w-100" data-bs-toggle="modal" data-bs-target="#modalReponses" id="getResults">Voir les réponses</a>
                <!-- </div> -->
                <!-- <div> -->
                <?php echo form_open("AllControllers/enterParametters", array("class" => "d-none")); ?>
                <input type="submit" class="d-none" id="clickToFinish">
                </form>
                <a href="#" id="btnQuitter" class="btn btn-outline-danger w-100">Quitter</a>
                <!-- </div> -->


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
                <p>Vous pouvez naviguer entre les questions qui suivent ou celles qui précèdent celle affichée sur l’écran principal.</p>
                <p>Vous pouvez également directement naviguer entre les différentes sections (français - culture générale - mathématiques - logique) mais aussi les différentes questions que chaque section (dans l’onglet liste des questions).</p>

                <p>Vous pouvez mettre fin à la session en cliquant sur "terminer la session".</p>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="modalReponses">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 p-3">
                                <div class="accordion shadow" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Sections
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse show collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <ul>
                                                    <?php for ($i = 0; $i < count($donnees_qcm); $i++) : ?>
                                                        <li>
                                                            <a href="#" data-section="<?php echo $donnees_qcm[$i]->section_nom; ?>" class="text-muted section-menu-anchor <?php if ($donnees_qcm[$i]->section_nom == $section) {
                                                                                                                                                                                echo 'activated';
                                                                                                                                                                            } ?>"><?php echo $donnees_qcm[$i]->section_nom; ?></a>
                                                        </li>
                                                    <?php endfor; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                Liste de questions
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <?php for ($d = 0; $d < count($donnees_qcm); $d++) : ?>
                                                    <?php
                                                    $afficheur = "d-none";

                                                    if ($donnees_qcm[$d]->section_nom == $section) {
                                                        $afficheur = "";
                                                    }
                                                    ?>
                                                    <ul data-section="<?php echo $donnees_qcm[$d]->section_nom; ?>" class="<?php echo $afficheur; ?> qst_list" style="height: 300px; overflow-y: auto;scrollbar-width: thin;-webkit-scrollbar-width: thin; padding-left:0px ;">
                                                        <?php for ($l = 0; $l < count($donnees_qcm[$d]->questions); $l++) : ?>
                                                            <?php $questions_reponses = $donnees_qcm[$d]->questions; ?>
                                                            <li style="font-size: 13px;font-weight:bold ;" class="mt-2">
                                                                <a data-tracer="<?php echo $donnees_qcm[$d]->section_nom; ?>" href="#" data-id="<?php echo $questions_reponses[$l]->question_id; ?>" class="hover-menu-qst shortcut-qst" style="color: #212529;"><?php echo $l + 1; ?>. <?php echo $questions_reponses[$l]->question_text; ?></a>
                                                            </li>
                                                        <?php endfor; ?>
                                                    </ul>
                                                <?php endfor; ?>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php for ($all = 0; $all < count($donnees_qcm); $all++) : ?>
                                <?php
                                $hideSectionByJumper = "d-none";
                                if ($donnees_qcm[$all]->section_nom == $section) {
                                    $hideSectionByJumper = "";
                                }

                                ?>
                                <div id="top-reponse" class="col-md-9 p-3 header-jumper-section <?php echo $hideSectionByJumper; ?>" data-section="<?php echo $donnees_qcm[$all]->section_nom; ?>">
                                    <?php for ($i = 0; $i < count($donnees_qcm[$all]->questions); $i++) : ?>
                                        <?php $questions_reponses = $donnees_qcm[$all]->questions; ?>
                                        <?php

                                        $toShow = "d-none";
                                        if ($i == 0) {
                                            $toShow = "";
                                        }
                                        ?>
                                        <div data-tracer="<?php echo $donnees_qcm[$all]->section_nom; ?>" class="card card-questions shadow <?php echo $toShow ?> qst-ID-<?php echo $questions_reponses[$i]->question_id ?>  qst-<?php echo $i + 1 ?>" data-id="qst-<?php echo $i + 1 ?>">
                                            <div class="card-header d-flex flex-row p-4" style="justify-content: space-between;background-color: white ;">
                                                <h5 class="text-center" style="font-weight: bold ;"><?php echo $donnees_qcm[$all]->section_nom; ?> </h5>
                                                <a href="#" class="the_heart heartNotFull" data-idqst="<?php echo $questions_reponses[$i]->question_id; ?>" data-section="<?php echo $donnees_qcm[$all]->section_nom; ?>" class="text-danger" style="font-size: 25px; color: red!important;"><i class="fa-regular fa-heart"></i></a>
                                                <a href="#" class="the_heart heartFull d-none" data-idqst="<?php echo $questions_reponses[$i]->question_id; ?>" data-section="<?php echo $donnees_qcm[$all]->section_nom; ?>" class="text-danger" style="font-size: 25px; color: red!important;"><i class="fa-solid fa-heart"></i></a>
                                            </div>
                                            <div class="card-body" style="min-height: 400px;">
                                                <div class="card-title">
                                                    <?php if ($questions_reponses[$i]->question_text != "") : ?>
                                                        <p style="font-weight: bold;"><?php echo $i + 1; ?>. <?php echo $questions_reponses[$i]->question_text; ?></p>
                                                        <?php if ($questions_reponses[$i]->question_image != "") : ?>
                                                            <img style="width: 100%;object-fit: contain;" src="<?php echo URL_ADMIN; ?>public/<?php echo $questions_reponses[$i]->question_image ?>" alt="">
                                                        <?php endif; ?>
                                                    <?php else : ?>
                                                        <img style="width: 100%;object-fit: contain;" src="<?php echo URL_ADMIN; ?>public/<?php echo $questions_reponses[$i]->question_image ?>" alt="">
                                                    <?php endif; ?>
                                                </div>
                                                <ul class="" style="list-style: none ;" data-remarque="0" data-idreponse="0" data-idquestion="<?php echo $questions_reponses[$i]->question_id; ?>">
                                                    <?php for ($a = 0; $a < count($questions_reponses[$i]->reponses); $a++) : ?>
                                                        <?php $reponse = $questions_reponses[$i]->reponses ?>
                                                        <li>

                                                            <?php if ($reponse[$a]->reponse_image != "") : ?>
                                                                <input disabled class="check-question-results numberOfElement check-question check-question-<?php echo $questions_reponses[$i]->question_id; ?>" type="checkbox" data-question="<?php echo $questions_reponses[$i]->question_id; ?>" data-remarque="<?php echo $reponse[$a]->reponse_remarque; ?>" data-idreponse="<?php echo $reponse[$a]->reponse_id; ?>">
                                                                <img style="width: 75px;object-fit: contain;" src="<?php echo URL_ADMIN; ?>public/<?php echo $reponse[$a]->reponse_image ?>" alt="">
                                                                <span class="text-success" style="font-weight: bold;"></span>
                                                            <?php else : ?>
                                                                <input disabled class="check-question-results numberOfElement check-question check-question-<?php echo $questions_reponses[$i]->question_id; ?>" type="checkbox" data-question="<?php echo $questions_reponses[$i]->question_id; ?>" data-remarque="<?php echo $reponse[$a]->reponse_remarque; ?>" data-idreponse="<?php echo $reponse[$a]->reponse_id; ?>"> <span class="numberOfElement"> <?php echo $reponse[$a]->reponse_contenu ?></span>
                                                                <span class="text-success" style="font-weight: bold;"></span>
                                                            <?php endif; ?>

                                                            
                                                        </li>
                                                    <?php endfor; ?>
                                                </ul>
                                            </div>
                                            <div class="card-footer">
                                                <p class="text-center p-3">
                                                    <span><a data-tracer="<?php echo $donnees_qcm[$all]->section_nom; ?>" href="#top-reponse" data-id="<?php echo $i ?>" class="btn btn-outline-primary page-prec" style="text-decoration: none ; font-weight: bold;"><span class="text-prec">Question précédente</span><i class="fas fa-arrow-left arrow-left"></i></a></span>
                                                    <span style="font-size: 20px; font-weight: bold;margin-left:10px" class="text-danger"><?php echo str_pad($i + 1, 2, "0", STR_PAD_LEFT) ?></span>
                                                    <span style="font-size: 20px;">/</span>
                                                    <span style="font-size: 20px; font-weight: bold;margin-right:10px"><?php echo count($donnees_qcm[$all]->questions); ?></span>
                                                    <span><a data-tracer="<?php echo $donnees_qcm[$all]->section_nom; ?>" href="#top-reponse" data-totale="<?php echo count($donnees_qcm[$all]->questions); ?>" data-id="<?php echo $i + 2 ?>" class="btn btn-outline-primary page-suiv" style="text-decoration: none ; font-weight: bold;"><span class="text-suiv">Question suivante</span><i class="fas fa-arrow-right arrow-right"></i></a></a></span>
                                                </p>

                                            </div>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            <?php endfor; ?>

                        </div>
                    </div>
                </div>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="fermerReponses">Fermer</button>
            </div>

        </div>
    </div>
</div>

<div class="d-none" id="data_evolution" data-totalsession="<?php echo $session_total; ?>" data-datasession='<?php echo $session ?>'></div>
<div class="modal fade" id="modalProgression">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div id="the_evolution" class="w-100" style="height: 600px;">

                </div>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="fermerProgression">Fermer</button>
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