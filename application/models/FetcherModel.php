<?php
class FetcherModel extends CI_Model
{

    public function getStateVersion()
    {
        $state = $this->db->query("SELECT * FROM etat WHERE 1")->result();
        return $state[0]->etat_version;
    }


    public function fetchAnnales($categorie_id, $annale_year)
    {
        $fiches =  $this->db->query("SELECT * FROM fiches INNER JOIN categorie ON fiches.categorie_id=categorie.categorie_id WHERE fiches.categorie_id='{$categorie_id}' AND fiches_contenu LIKE '%{$annale_year}%'")->result();
        $section = $this->db->query("SELECT * FROM section WHERE categorie_id='{$categorie_id}'")->result();
        if (count($section) > 0) {
            for ($i = 0; $i < count($section); $i++) {
                $section[$i]->fiches_contenu = $fiches[0]->fiches_contenu;
                $section[$i]->categorie_nom = $fiches[0]->categorie_nom;
                $data_limit = 10;
                switch ($section[$i]->section_nom) {
                    case "Français":
                        $data_limit = 16;
                        break;
                    case "Culture générale":
                        $data_limit = 15;
                        break;
                    case "Mathématiques":
                        $data_limit = 13;
                        break;
                    case "Logique":
                        $data_limit = 10;
                        break;
                }
                $data_question = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' ORDER BY RAND() LIMIT {$data_limit}")->result();

                for ($j = 0; $j < count($data_question); $j++) {
                    $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data_question[$j]->question_id}'")->result();
                    if (count($data_reponses) > 0) {
                        $data_question[$j]->reponses = $data_reponses;
                    }
                }
                $section[$i]->questions = $data_question;
            }
            return $section;
        } else {
            return 0;
        }
    }

    public function fetchAttache()
    {
        $section = $this->db->query("SELECT * FROM section WHERE categorie_id='24'")->result();
        for ($i = 0; $i < count($section); $i++) {
            switch ($section[$i]->section_nom) {
                case "Culture administrative et juridique":
                    /**
                     *  Total: 60 questions
                     *  46 -> 2020-0, 2020-2, 2021-1, 2021-2, 2022-1, 2022-2
                     *  2 -> IGPDE
                     *  2 -> Vuibert
                     *  1 -> Gualino 1
                     *  1 -> Gualino 2
                     *  1 -> Gualino 3
                     *  1 -> Gualino 4
                     *  1 -> Studyrama 1
                     *  1 -> Studyrama 2
                     *  1 -> Studyrama 3
                     *  1 -> Studyrama 4
                     *  1 -> Studyrama 5
                     *  1 -> Studyrama 6
                     *  
                     * 
                     * 
                     */
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND (titre LIKE '%2020-0%' OR titre LIKE '%2020-2%' OR titre LIKE '%2021-1%' OR titre LIKE '%2021-2%' OR titre LIKE '%2022-1%' OR titre LIKE '%2022-2%') ORDER BY RAND() LIMIT 46")->result();
                    // $data2020_2 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2020-2%' ORDER BY RAND() LIMIT 8")->result();
                    // $data2021_1 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2021-1%' ORDER BY RAND() LIMIT 6")->result();
                    // $data2021_2 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2021-2%' ORDER BY RAND() LIMIT 8")->result();
                    // $data2022_1 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2022-1%' ORDER BY RAND() LIMIT 8")->result();
                    // $data2022_2 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2022-2%' ORDER BY RAND() LIMIT 8")->result();
                    $IGPDE = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%igpde%' ORDER BY RAND() LIMIT 2")->result();
                    $vuibert = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%vuibert%' ORDER BY RAND() LIMIT 2")->result();
                    $gualino1 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%gualino 1%' ORDER BY RAND() LIMIT 1")->result();
                    $gualino2 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%gualino 2%' ORDER BY RAND() LIMIT 1")->result();
                    $gualino3 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%gualino 3' ORDER BY RAND() LIMIT 1")->result();
                    $gualino4 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%gualino 4' ORDER BY RAND() LIMIT 1")->result();
                    $studyrama1 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%studyrama 1' ORDER BY RAND() LIMIT 1")->result();
                    $studyrama2 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%studyrama 2%' ORDER BY RAND() LIMIT 1")->result();
                    $studyrama3 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%studyrama 3%' ORDER BY RAND() LIMIT 1")->result();
                    $studyrama4 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%studyrama 4' ORDER BY RAND() LIMIT 1")->result();
                    $studyrama5 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%studyrama 5%' ORDER BY RAND() LIMIT 1")->result();
                    $studyrama6 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%studyrama 6%' ORDER BY RAND() LIMIT 1")->result();
                    $array_questions = [];
                    if (count($data2020_0) > 0) {


                        for ($j = 0; $j < count($data2020_0); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2020_0[$j]->question_id}' ORDER BY RAND() LIMIT 3")->result();
                            if (count($data_reponses) > 0) {
                                $data2020_0[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $data2020_0[$j]);
                        }
                    }

                    // if (count($data2020_2) > 0) {

                    //     for ($j = 0; $j < count($data2020_2); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2020_2[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2020_2[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2020_2[$j]);
                    //     }
                    // }

                    // if (count($data2021_1) > 0) {

                    //     for ($j = 0; $j < count($data2021_1); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2021_1[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2021_1[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2021_1[$j]);
                    //     }
                    // }

                    // if (count($data2021_2) > 0) {

                    //     for ($j = 0; $j < count($data2021_2); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2021_2[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2021_2[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2021_2[$j]);
                    //     }
                    // }

                    // if (count($data2022_1) > 0) {

                    //     for ($j = 0; $j < count($data2022_1); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2022_1[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2022_1[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2022_1[$j]);
                    //     }
                    // }

                    // if (count($data2022_2) > 0) {

                    //     for ($j = 0; $j < count($data2022_2); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2022_2[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2022_2[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2022_2[$j]);
                    //     }
                    // }

                    if (count($IGPDE) > 0) {

                        for ($j = 0; $j < count($IGPDE); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$IGPDE[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $IGPDE[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $IGPDE[$j]);
                        }
                    }

                    if (count($vuibert) > 0) {

                        for ($j = 0; $j < count($vuibert); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$vuibert[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $vuibert[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $vuibert[$j]);
                        }
                    }

                    if (count($gualino1) > 0) {

                        for ($j = 0; $j < count($gualino1); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$gualino1[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $gualino1[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $gualino1[$j]);
                        }
                    }

                    if (count($gualino2) > 0) {

                        for ($j = 0; $j < count($gualino2); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$gualino2[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $gualino2[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $gualino2[$j]);
                        }
                    }

                    if (count($gualino3) > 0) {

                        for ($j = 0; $j < count($gualino3); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$gualino3[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $gualino3[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $gualino3[$j]);
                        }
                    }

                    if (count($gualino4) > 0) {

                        for ($j = 0; $j < count($gualino4); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$gualino4[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $gualino4[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $gualino4[$j]);
                        }
                    }

                    if (count($studyrama1) > 0) {

                        for ($j = 0; $j < count($studyrama1); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$studyrama1[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $studyrama1[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $studyrama1[$j]);
                        }
                    }
                    if (count($studyrama2) > 0) {

                        for ($j = 0; $j < count($studyrama2); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$studyrama2[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $studyrama2[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $studyrama2[$j]);
                        }
                    }

                    if (count($studyrama3) > 0) {

                        for ($j = 0; $j < count($studyrama3); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$studyrama3[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $studyrama3[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $studyrama3[$j]);
                        }
                    }

                    if (count($studyrama4) > 0) {

                        for ($j = 0; $j < count($studyrama4); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$studyrama4[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $studyrama4[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $studyrama4[$j]);
                        }
                    }

                    if (count($studyrama5) > 0) {

                        for ($j = 0; $j < count($studyrama5); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$studyrama5[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $studyrama5[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $studyrama5[$j]);
                        }
                    }

                    if (count($studyrama6) > 0) {

                        for ($j = 0; $j < count($studyrama6); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$studyrama6[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $studyrama6[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $studyrama6[$j]);
                        }
                    }


                    $section[$i]->questions = $array_questions;

                    break;
                case "Finances publiques":
                    /**
                     *  Total: 20 questions
                     *  10 -> 2020-0, 2020-2, 2021-1, 2021-2, 2022-1, 2022-2
                     *  1 -> IGPDE
                     *  1 -> Vuibert
                     *  3 -> Gualino 1/2/3/4
                     *  5 -> Studyrama 1/2/3/4/5/6
                     * 
                     */
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND (titre LIKE '%2020-0%' OR titre LIKE '%2020-2%' OR titre LIKE '%2021-1%' OR titre LIKE '%2021-2%' OR titre LIKE '%2022-1%' OR titre LIKE '%2022-2%') ORDER BY RAND() LIMIT 10")->result();
                    // $data2020_2 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2020-2%' ORDER BY RAND() LIMIT 2")->result();
                    // $data2021_1 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2021-1%' ORDER BY RAND() LIMIT 2")->result();
                    // $data2021_2 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2021-2%' ORDER BY RAND() LIMIT 1")->result();
                    // $data2022_1 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2022-1%' ORDER BY RAND() LIMIT 1")->result();
                    // $data2022_2 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2022-2%' ORDER BY RAND() LIMIT 2")->result();
                    $IGPDE = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%igpde%' ORDER BY RAND() LIMIT 1")->result();
                    $vuibert = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%vuibert%' ORDER BY RAND() LIMIT 1")->result();
                    $gualino1 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%gualino 1%' ORDER BY RAND() LIMIT 3")->result();
                    $studyrama1 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%studyrama 1' ORDER BY RAND() LIMIT 5")->result();
                    $array_questions = [];
                    if (count($data2020_0) > 0) {


                        for ($j = 0; $j < count($data2020_0); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2020_0[$j]->question_id}' ORDER BY RAND() LIMIT 3")->result();
                            if (count($data_reponses) > 0) {
                                $data2020_0[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $data2020_0[$j]);
                        }
                    }

                    // if (count($data2020_2) > 0) {

                    //     for ($j = 0; $j < count($data2020_2); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2020_2[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2020_2[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2020_2[$j]);
                    //     }
                    // }

                    // if (count($data2021_1) > 0) {

                    //     for ($j = 0; $j < count($data2021_1); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2021_1[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2021_1[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2021_1[$j]);
                    //     }
                    // }

                    // if (count($data2021_2) > 0) {

                    //     for ($j = 0; $j < count($data2021_2); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2021_2[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2021_2[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2021_2[$j]);
                    //     }
                    // }

                    // if (count($data2022_1) > 0) {

                    //     for ($j = 0; $j < count($data2022_1); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2022_1[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2022_1[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2022_1[$j]);
                    //     }
                    // }

                    // if (count($data2022_2) > 0) {

                    //     for ($j = 0; $j < count($data2022_2); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2022_2[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2022_2[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2022_2[$j]);
                    //     }
                    // }

                    if (count($IGPDE) > 0) {

                        for ($j = 0; $j < count($IGPDE); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$IGPDE[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $IGPDE[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $IGPDE[$j]);
                        }
                    }

                    if (count($vuibert) > 0) {

                        for ($j = 0; $j < count($vuibert); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$vuibert[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $vuibert[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $vuibert[$j]);
                        }
                    }

                    if (count($gualino1) > 0) {

                        for ($j = 0; $j < count($gualino1); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$gualino1[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $gualino1[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $gualino1[$j]);
                        }
                    }

                    if (count($studyrama1) > 0) {

                        for ($j = 0; $j < count($studyrama1); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$studyrama1[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $studyrama1[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $studyrama1[$j]);
                        }
                    }


                    $section[$i]->questions = $array_questions;
                    break;
                case "Les institutions européennes":
                    /**
                     *  Total: 20 questions
                     *  10 -> 2020-0, 2020-2, 2021-1, 2021-2, 2022-1, 2022-2
                     *  1 -> IGPDE
                     *  1 -> Vuibert
                     *  3 -> Gualino 1/2/3/4
                     *  5 -> Studyrama 1/2/3/4/5/6
                     * 
                     */
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND (titre LIKE '%2020-0%' OR titre LIKE '%2020-2%' OR titre LIKE '%2021-1%' OR titre LIKE '%2021-2%' OR titre LIKE '%2022-1%' OR titre LIKE '%2022-2%') ORDER BY RAND() LIMIT 10")->result();
                    // $data2020_2 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2020-2%' ORDER BY RAND() LIMIT 1")->result();
                    // $data2021_1 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2021-1%' ORDER BY RAND() LIMIT 2")->result();
                    // $data2021_2 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2021-2%' ORDER BY RAND() LIMIT 2")->result();
                    // $data2022_1 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2022-1%' ORDER BY RAND() LIMIT 1")->result();
                    // $data2022_2 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2022-2%' ORDER BY RAND() LIMIT 2")->result();
                    $IGPDE = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%igpde%' ORDER BY RAND() LIMIT 1")->result();
                    $vuibert = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%vuibert%' ORDER BY RAND() LIMIT 1")->result();
                    $gualino1 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%gualino 1%' ORDER BY RAND() LIMIT 3")->result();
                    $studyrama1 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%studyrama 1' ORDER BY RAND() LIMIT 5")->result();
                    $array_questions = [];
                    if (count($data2020_0) > 0) {


                        for ($j = 0; $j < count($data2020_0); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2020_0[$j]->question_id}' ORDER BY RAND() LIMIT 3")->result();
                            if (count($data_reponses) > 0) {
                                $data2020_0[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $data2020_0[$j]);
                        }
                    }

                    // if (count($data2020_2) > 0) {

                    //     for ($j = 0; $j < count($data2020_2); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2020_2[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2020_2[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2020_2[$j]);
                    //     }
                    // }

                    // if (count($data2021_1) > 0) {

                    //     for ($j = 0; $j < count($data2021_1); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2021_1[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2021_1[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2021_1[$j]);
                    //     }
                    // }

                    // if (count($data2021_2) > 0) {

                    //     for ($j = 0; $j < count($data2021_2); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2021_2[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2021_2[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2021_2[$j]);
                    //     }
                    // }

                    // if (count($data2022_1) > 0) {

                    //     for ($j = 0; $j < count($data2022_1); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2022_1[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2022_1[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2022_1[$j]);
                    //     }
                    // }

                    // if (count($data2022_2) > 0) {

                    //     for ($j = 0; $j < count($data2022_2); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2022_2[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2022_2[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2022_2[$j]);
                    //     }
                    // }

                    if (count($IGPDE) > 0) {

                        for ($j = 0; $j < count($IGPDE); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$IGPDE[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $IGPDE[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $IGPDE[$j]);
                        }
                    }

                    if (count($vuibert) > 0) {

                        for ($j = 0; $j < count($vuibert); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$vuibert[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $vuibert[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $vuibert[$j]);
                        }
                    }

                    if (count($gualino1) > 0) {

                        for ($j = 0; $j < count($gualino1); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$gualino1[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $gualino1[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $gualino1[$j]);
                        }
                    }

                    if (count($studyrama1) > 0) {

                        for ($j = 0; $j < count($studyrama1); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$studyrama1[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $studyrama1[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $studyrama1[$j]);
                        }
                    }


                    $section[$i]->questions = $array_questions;
                    break;
                case "Culture numérique":
                    /**
                     *  Total: 20 questions
                     *  10 -> 2020-0, 2020-2, 2021-1, 2021-2, 2022-1, 2022-2
                     *  1 -> IGPDE
                     *  1 -> Vuibert
                     *  3 -> Gualino 1/2/3/4
                     *  5 -> Studyrama 1/2/3/4/5/6
                     * 
                     */
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND (titre LIKE '%2020-0%' OR titre LIKE '%2020-2%' OR titre LIKE '%2021-1%' OR titre LIKE '%2021-2%' OR titre LIKE '%2022-1%' OR titre LIKE '%2022-2%') ORDER BY RAND() LIMIT 10")->result();
                    // $data2020_2 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2020-2%' ORDER BY RAND() LIMIT 1")->result();
                    // $data2021_1 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2021-1%' ORDER BY RAND() LIMIT 2")->result();
                    // $data2021_2 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2021-2%' ORDER BY RAND() LIMIT 1")->result();
                    // $data2022_1 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2022-1%' ORDER BY RAND() LIMIT 2")->result();
                    // $data2022_2 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%2022-2%' ORDER BY RAND() LIMIT 2")->result();
                    $IGPDE = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%igpde%' ORDER BY RAND() LIMIT 1")->result();
                    $vuibert = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%vuibert%' ORDER BY RAND() LIMIT 1")->result();
                    $gualino1 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%gualino 1%' ORDER BY RAND() LIMIT 3")->result();
                    $studyrama1 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre LIKE '%studyrama 1' ORDER BY RAND() LIMIT 5")->result();
                    $array_questions = [];
                    if (count($data2020_0) > 0) {


                        for ($j = 0; $j < count($data2020_0); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2020_0[$j]->question_id}' ORDER BY RAND() LIMIT 3")->result();
                            if (count($data_reponses) > 0) {
                                $data2020_0[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $data2020_0[$j]);
                        }
                    }

                    // if (count($data2020_2) > 0) {

                    //     for ($j = 0; $j < count($data2020_2); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2020_2[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2020_2[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2020_2[$j]);
                    //     }
                    // }

                    // if (count($data2021_1) > 0) {

                    //     for ($j = 0; $j < count($data2021_1); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2021_1[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2021_1[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2021_1[$j]);
                    //     }
                    // }

                    // if (count($data2021_2) > 0) {

                    //     for ($j = 0; $j < count($data2021_2); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2021_2[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2021_2[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2021_2[$j]);
                    //     }
                    // }

                    // if (count($data2022_1) > 0) {

                    //     for ($j = 0; $j < count($data2022_1); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2022_1[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2022_1[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2022_1[$j]);
                    //     }
                    // }

                    // if (count($data2022_2) > 0) {

                    //     for ($j = 0; $j < count($data2022_2); $j++) {
                    //         $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2022_2[$j]->question_id}'")->result();
                    //         if (count($data_reponses) > 0) {
                    //             $data2022_2[$j]->reponses = $data_reponses;
                    //         }
                    //         array_push($array_questions, $data2022_2[$j]);
                    //     }
                    // }

                    if (count($IGPDE) > 0) {

                        for ($j = 0; $j < count($IGPDE); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$IGPDE[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $IGPDE[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $IGPDE[$j]);
                        }
                    }

                    if (count($vuibert) > 0) {

                        for ($j = 0; $j < count($vuibert); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$vuibert[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $vuibert[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $vuibert[$j]);
                        }
                    }

                    if (count($gualino1) > 0) {

                        for ($j = 0; $j < count($gualino1); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$gualino1[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $gualino1[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $gualino1[$j]);
                        }
                    }

                    if (count($studyrama1) > 0) {

                        for ($j = 0; $j < count($studyrama1); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$studyrama1[$j]->question_id}'")->result();
                            if (count($data_reponses) > 0) {
                                $studyrama1[$j]->reponses = $data_reponses;
                            }
                            array_push($array_questions, $studyrama1[$j]);
                        }
                    }


                    $section[$i]->questions = $array_questions;
                    break;
            }
        }


        return $section;
    }

    public function getAllBoky()
    {
        $section_body = $this->db->query("SELECT * FROM section WHERE categorie_id='28'")->result();

        // douane 2010, douane 2011, douane 2012, douane 2013, douane 2014, douane 2015, douane FR CultG exercices corrigés math LOG inédit avec R
        for ($d = 0; $d < count($section_body); $d++) {
            switch ($section_body[$d]->section_nom) {
                case "Culture générale":
                    $douane2010 = $this->db->query("SELECT * FROM question WHERE section_id='{$section_body[$d]->section_id}' AND (titre LIKE '%douane 2010%' OR titre LIKE '%douane 2011%' OR titre LIKE '%douane 2012%' OR titre LIKE '%douane 2013%' OR titre LIKE '%douane 2014%' OR titre LIKE '%douane 2015%' OR titre LIKE '%douane FR CultG exercices corrigés math LOG inédit avec R%') ORDER BY RAND() LIMIT 7")->result();

                    $array_questions = [];
                    if (count($douane2010) > 0) {


                        for ($j = 0; $j < count($douane2010); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$douane2010[$j]->question_id}' ORDER BY RAND() LIMIT 7")->result();

                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }

                                $douane2010[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $douane2010[$j]);
                        }
                    }


                    $section_body[$d]->questions = $array_questions;

                    break;
                case "Français":
                    $douane2010 = $this->db->query("SELECT * FROM question WHERE section_id='{$section_body[$d]->section_id}' AND (titre LIKE '%douane 2010%' OR titre LIKE '%douane 2011%' OR titre LIKE '%douane 2012%' OR titre LIKE '%douane 2013%' OR titre LIKE '%douane 2014%' OR titre LIKE '%douane 2015%' OR titre LIKE '%douane FR CultG exercices corrigés math LOG inédit avec R%') ORDER BY RAND() LIMIT 7")->result();

                    $array_questions = [];
                    if (count($douane2010) > 0) {


                        for ($j = 0; $j < count($douane2010); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$douane2010[$j]->question_id}' ORDER BY RAND() LIMIT 7")->result();

                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }

                                $douane2010[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $douane2010[$j]);
                        }
                    }


                    $section_body[$d]->questions = $array_questions;



                    break;
                case "Logique":
                    $douane2010 = $this->db->query("SELECT * FROM question WHERE section_id='{$section_body[$d]->section_id}' AND (titre LIKE '%douane 2010%' OR titre LIKE '%douane 2011%' OR titre LIKE '%douane 2012%' OR titre LIKE '%douane 2013%' OR titre LIKE '%douane 2014%' OR titre LIKE '%douane 2015%' OR titre LIKE '%douane FR CultG exercices corrigés math LOG inédit avec R%') ORDER BY RAND() LIMIT 7")->result();

                    $array_questions = [];
                    if (count($douane2010) > 0) {


                        for ($j = 0; $j < count($douane2010); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$douane2010[$j]->question_id}' ORDER BY RAND() LIMIT 7")->result();

                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }

                                $douane2010[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $douane2010[$j]);
                        }
                    }


                    $section_body[$d]->questions = $array_questions;


                    break;
                case "Mathématiques":
                    $douane2010 = $this->db->query("SELECT * FROM question WHERE section_id='{$section_body[$d]->section_id}' AND (titre LIKE '%douane 2010%' OR titre LIKE '%douane 2011%' OR titre LIKE '%douane 2012%' OR titre LIKE '%douane 2013%' OR titre LIKE '%douane 2014%' OR titre LIKE '%douane 2015%' OR titre LIKE '%douane FR CultG exercices corrigés math LOG inédit avec R%') ORDER BY RAND() LIMIT 7")->result();

                    $array_questions = [];
                    if (count($douane2010) > 0) {


                        for ($j = 0; $j < count($douane2010); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$douane2010[$j]->question_id}' ORDER BY RAND() LIMIT 7")->result();

                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }

                                $douane2010[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $douane2010[$j]);
                        }
                    }


                    $section_body[$d]->questions = $array_questions;


                    break;
            }
        }
        $newSection = [$section_body[1], $section_body[0], $section_body[2], $section_body[3]];

        return $newSection;
    }
    public function fetchCFipu()
    {
        $section = $this->db->query("SELECT * FROM section WHERE categorie_id='23'")->result();

        // cg 15, fr 16, log 10, maths 13
        for ($i = 0; $i < count($section); $i++) {
            switch ($section[$i]->section_nom) {
                case "Culture générale":

                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND (titre LIKE '%2023%' OR titre LIKE '%2022%') ORDER BY RAND() LIMIT 8")->result();

                    $array_questions = [];
                    if (count($data2020_0) > 0) {


                        for ($j = 0; $j < count($data2020_0); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2020_0[$j]->question_id}' ORDER BY RAND() LIMIT 7")->result();

                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }

                                $data2020_0[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $data2020_0[$j]);
                        }
                    }


                    $section[$i]->questions = $array_questions;

                    break;
                case "Français":
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND (titre LIKE '%2023%' OR titre LIKE '%2022%') ORDER BY RAND() LIMIT 9")->result();

                    $array_questions = [];
                    if (count($data2020_0) > 0) {


                        for ($j = 0; $j < count($data2020_0); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2020_0[$j]->question_id}' ORDER BY RAND() LIMIT 7")->result();
                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                $data2020_0[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $data2020_0[$j]);
                        }
                    }


                    $section[$i]->questions = $array_questions;
                    break;
                case "Logique":
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND (titre LIKE '%2023%' OR titre LIKE '%2022%') ORDER BY RAND() LIMIT 3")->result();

                    $array_questions = [];
                    if (count($data2020_0) > 0) {


                        for ($j = 0; $j < count($data2020_0); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2020_0[$j]->question_id}' ORDER BY RAND() LIMIT 7")->result();
                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                $data2020_0[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $data2020_0[$j]);
                        }
                    }


                    $section[$i]->questions = $array_questions;
                    break;
                case "Mathématiques":
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND (titre LIKE '%2023%' OR titre LIKE '%2022%') ORDER BY RAND() LIMIT 6")->result();

                    $array_questions = [];
                    if (count($data2020_0) > 0) {


                        for ($j = 0; $j < count($data2020_0); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2020_0[$j]->question_id}' ORDER BY RAND() LIMIT 7")->result();
                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                $data2020_0[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $data2020_0[$j]);
                        }
                    }


                    $section[$i]->questions = $array_questions;
                    break;
            }
        }



        // Ordre: Francais, culture g, maths, logiques
        $newSection = [$section[1], $section[3], $section[0], $section[2]];

        $boky = $this->getAllBoky();

        for ($s = 0; $s < count($newSection); $s++) {
            $newSection[$s]->questions = array_merge($newSection[$s]->questions, $boky[$s]->questions);

            $shuffled = shuffle($newSection[$s]->questions);
            $newSection[$s]->questions = $newSection[$s]->questions;
        }
        return $newSection;
    }

    public function fetchAFipu()
    {
        // cg 15, fr 16, log 10, maths 13
        $section = $this->db->query("SELECT * FROM section WHERE categorie_id='22'")->result();
        for ($i = 0; $i < count($section); $i++) {
            switch ($section[$i]->section_nom) {
                case "Culture générale":

                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND (titre LIKE '%2007%' OR titre LIKE '%2009%' OR titre LIKE '%2010%' OR titre LIKE '%2011%' OR titre LIKE '%2012%' OR titre LIKE '%2013%' OR titre LIKE '%2014%' OR titre LIKE '%2015%' OR titre LIKE '%2016%' OR titre LIKE '%2017%' OR titre LIKE '%2018%' OR titre LIKE '%2019%' OR titre LIKE '%2020%' OR titre LIKE '%2021%' OR titre LIKE '%2022%') ORDER BY RAND() LIMIT 8")->result();

                    $array_questions = [];
                    if (count($data2020_0) > 0) {


                        for ($j = 0; $j < count($data2020_0); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2020_0[$j]->question_id}' ORDER BY RAND() LIMIT 7")->result();

                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                $data2020_0[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $data2020_0[$j]);
                        }
                    }


                    $section[$i]->questions = $array_questions;

                    break;
                case "Français":
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND (titre LIKE '%2007%' OR titre LIKE '%2009%' OR titre LIKE '%2010%' OR titre LIKE '%2011%' OR titre LIKE '%2012%' OR titre LIKE '%2013%' OR titre LIKE '%2014%' OR titre LIKE '%2015%' OR titre LIKE '%2016%' OR titre LIKE '%2017%' OR titre LIKE '%2018%' OR titre LIKE '%2019%' OR titre LIKE '%2020%' OR titre LIKE '%2021%' OR titre LIKE '%2022%') ORDER BY RAND() LIMIT 9")->result();

                    $array_questions = [];
                    if (count($data2020_0) > 0) {


                        for ($j = 0; $j < count($data2020_0); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2020_0[$j]->question_id}' ORDER BY RAND() LIMIT 7")->result();
                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                $data2020_0[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $data2020_0[$j]);
                        }
                    }


                    $section[$i]->questions = $array_questions;
                    break;
                case "Logique":
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND (titre LIKE '%2007%' OR titre LIKE '%2009%' OR titre LIKE '%2010%' OR titre LIKE '%2011%' OR titre LIKE '%2012%' OR titre LIKE '%2013%' OR titre LIKE '%2014%' OR titre LIKE '%2015%' OR titre LIKE '%2016%' OR titre LIKE '%2017%' OR titre LIKE '%2018%' OR titre LIKE '%2019%' OR titre LIKE '%2020%' OR titre LIKE '%2021%' OR titre LIKE '%2022%') ORDER BY RAND() LIMIT 3")->result();

                    $array_questions = [];
                    if (count($data2020_0) > 0) {


                        for ($j = 0; $j < count($data2020_0); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2020_0[$j]->question_id}' ORDER BY RAND() LIMIT 7")->result();
                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                $data2020_0[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $data2020_0[$j]);
                        }
                    }


                    $section[$i]->questions = $array_questions;
                    break;
                case "Mathématiques":
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND (titre LIKE '%2007%' OR titre LIKE '%2009%' OR titre LIKE '%2010%' OR titre LIKE '%2011%' OR titre LIKE '%2012%' OR titre LIKE '%2013%' OR titre LIKE '%2014%' OR titre LIKE '%2015%' OR titre LIKE '%2016%' OR titre LIKE '%2017%' OR titre LIKE '%2018%' OR titre LIKE '%2019%' OR titre LIKE '%2020%' OR titre LIKE '%2021%' OR titre LIKE '%2022%') ORDER BY RAND() LIMIT 6")->result();

                    $array_questions = [];
                    if (count($data2020_0) > 0) {


                        for ($j = 0; $j < count($data2020_0); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2020_0[$j]->question_id}' ORDER BY RAND() LIMIT 7")->result();
                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                $data2020_0[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $data2020_0[$j]);
                        }
                    }


                    $section[$i]->questions = $array_questions;
                    break;
            }
        }
        // Ordre: Francais, culture g, maths, logiques
        $newSection = [$section[2], $section[3], $section[1], $section[0]];
        $boky = $this->getAllBoky();

        for ($s = 0; $s < count($newSection); $s++) {
            $newSection[$s]->questions = array_merge($newSection[$s]->questions, $boky[$s]->questions);

            $shuffled = shuffle($newSection[$s]->questions);
            $newSection[$s]->questions = $newSection[$s]->questions;
        }
        return $newSection;
    }



    public function getDataForRevisionAFipu($email)
    {
        $data = $this->db->query("SELECT * FROM favoris WHERE clients_id='{$email}' AND type='fipu' ORDER BY id_favoris ASC")->result();
        $section = $this->db->query("SELECT * FROM section WHERE categorie_id='22'")->result();
        $data_to_compare = [];
        for ($kk = 0; $kk < count($data); $kk++) {
            array_push($data_to_compare, $data[$kk]->question_id);
        }

        for ($i = 0; $i < count($section); $i++) {
            switch ($section[$i]->section_nom) {
                case "Culture générale":
                    $qst = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' ORDER BY question_id ASC")->result();
                    $array_questions = [];
                    if (count($qst) > 0) {


                        for ($j = 0; $j < count($qst); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$qst[$j]->question_id}' ORDER BY question_id ASC")->result();
                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                // $data2020_0[$j]->reponses = $newArray;
                                $qst[$j]->reponses = $newArray;

                                // var_dump($newArray) ;
                                // die() ;
                            }

                            if (in_array($qst[$j]->question_id, $data_to_compare)) {
                                array_push($array_questions, $qst[$j]);
                            }
                        }
                    }

                    // $newSection = [$section[2], $section[3], $section[1], $section[0]];
                    $section[$i]->questions = $array_questions;


                    break;
                case "Français":
                    $qst = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' ORDER BY question_id ASC")->result();
                    $array_questions = [];
                    if (count($qst) > 0) {


                        for ($j = 0; $j < count($qst); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$qst[$j]->question_id}' ORDER BY question_id ASC")->result();
                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                // $data2020_0[$j]->reponses = $newArray;
                                $qst[$j]->reponses = $newArray;
                            }

                            if (in_array($qst[$j]->question_id, $data_to_compare)) {
                                array_push($array_questions, $qst[$j]);
                            }
                        }
                    }

                    // $newSection = [$section[2], $section[3], $section[1], $section[0]];
                    $section[$i]->questions = $array_questions;
                    break;
                case "Logique":
                    $qst = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' ORDER BY question_id ASC")->result();
                    $array_questions = [];
                    if (count($qst) > 0) {


                        for ($j = 0; $j < count($qst); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$qst[$j]->question_id}' ORDER BY question_id ASC")->result();
                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                // $data2020_0[$j]->reponses = $newArray;
                                $qst[$j]->reponses = $newArray;
                            }

                            if (in_array($qst[$j]->question_id, $data_to_compare)) {
                                array_push($array_questions, $qst[$j]);
                            }
                        }
                    }

                    // $newSection = [$section[2], $section[3], $section[1], $section[0]];
                    $section[$i]->questions = $array_questions;
                    break;
                case "Mathématiques":
                    $qst = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' ORDER BY question_id ASC")->result();
                    $array_questions = [];
                    if (count($qst) > 0) {


                        for ($j = 0; $j < count($qst); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$qst[$j]->question_id}' ORDER BY question_id ASC")->result();
                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                // $data2020_0[$j]->reponses = $newArray;
                                $qst[$j]->reponses = $newArray;
                            }

                            if (in_array($qst[$j]->question_id, $data_to_compare)) {
                                array_push($array_questions, $qst[$j]);
                            }
                        }
                    }

                    // $newSection = [$section[2], $section[3], $section[1], $section[0]];
                    $section[$i]->questions = $array_questions;
                    break;
            }
        }

        return $section;
    }

    public function getDataForRevisionCFipu($email)
    {
        $data = $this->db->query("SELECT * FROM favoris WHERE clients_id='{$email}' AND type='fipu' ORDER BY id_favoris ASC")->result();
        $section = $this->db->query("SELECT * FROM section WHERE categorie_id='23'")->result();
        $data_to_compare = [];
        for ($kk = 0; $kk < count($data); $kk++) {
            array_push($data_to_compare, $data[$kk]->question_id);
        }

        for ($i = 0; $i < count($section); $i++) {
            switch ($section[$i]->section_nom) {
                case "Culture générale":
                    $qst = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' ORDER BY question_id ASC")->result();
                    $array_questions = [];
                    if (count($qst) > 0) {


                        for ($j = 0; $j < count($qst); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$qst[$j]->question_id}' ORDER BY question_id ASC")->result();
                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                // $data2020_0[$j]->reponses = $newArray;
                                $qst[$j]->reponses = $newArray;

                                // var_dump($newArray) ;
                                // die() ;
                            }

                            if (in_array($qst[$j]->question_id, $data_to_compare)) {
                                array_push($array_questions, $qst[$j]);
                            }
                        }
                    }

                    // $newSection = [$section[2], $section[3], $section[1], $section[0]];
                    $section[$i]->questions = $array_questions;


                    break;
                case "Français":
                    $qst = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' ORDER BY question_id ASC")->result();
                    $array_questions = [];
                    if (count($qst) > 0) {


                        for ($j = 0; $j < count($qst); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$qst[$j]->question_id}' ORDER BY question_id ASC")->result();
                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                // $data2020_0[$j]->reponses = $newArray;
                                $qst[$j]->reponses = $newArray;
                            }

                            if (in_array($qst[$j]->question_id, $data_to_compare)) {
                                array_push($array_questions, $qst[$j]);
                            }
                        }
                    }

                    // $newSection = [$section[2], $section[3], $section[1], $section[0]];
                    $section[$i]->questions = $array_questions;
                    break;
                case "Logique":
                    $qst = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' ORDER BY question_id ASC")->result();
                    $array_questions = [];
                    if (count($qst) > 0) {


                        for ($j = 0; $j < count($qst); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$qst[$j]->question_id}' ORDER BY question_id ASC")->result();
                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                // $data2020_0[$j]->reponses = $newArray;
                                $qst[$j]->reponses = $newArray;
                            }

                            if (in_array($qst[$j]->question_id, $data_to_compare)) {
                                array_push($array_questions, $qst[$j]);
                            }
                        }
                    }

                    // $newSection = [$section[2], $section[3], $section[1], $section[0]];
                    $section[$i]->questions = $array_questions;
                    break;
                case "Mathématiques":
                    $qst = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' ORDER BY question_id ASC")->result();
                    $array_questions = [];
                    if (count($qst) > 0) {


                        for ($j = 0; $j < count($qst); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$qst[$j]->question_id}' ORDER BY question_id ASC")->result();
                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                // $data2020_0[$j]->reponses = $newArray;
                                $qst[$j]->reponses = $newArray;
                            }

                            if (in_array($qst[$j]->question_id, $data_to_compare)) {
                                array_push($array_questions, $qst[$j]);
                            }
                        }
                    }

                    // $newSection = [$section[2], $section[3], $section[1], $section[0]];
                    $section[$i]->questions = $array_questions;
                    break;
            }
        }

        return $section;
    }

    public function fetchAFipuLastest()
    {
        $date = "année 2022";
        $section = $this->db->query("SELECT * FROM section WHERE categorie_id='22'")->result();
        // for ($i = 0; $i < count($section); $i++) {
        //     switch ($section[$i]->section_nom) {
        //         case "Culture administrative et juridique":
        //             $qst = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre='{$date}' ORDER BY question_id ASC")->result();
        //             $array_questions = [];
        //             if (count($qst) > 0) {


        //                 for ($j = 0; $j < count($qst); $j++) {
        //                     $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$qst[$j]->question_id}' ORDER BY question_id ASC")->result();
        //                     if (count($data_reponses) > 0) {
        //                         $qst[$j]->reponses = $data_reponses;
        //                     }
        //                     array_push($array_questions, $qst[$j]);
        //                 }
        //             }


        //             $section[$i]->questions = $array_questions;

        //             break;
        //         case "Finances publiques":

        //             $qst = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre='{$date}' ORDER BY question_id ASC")->result();
        //             $array_questions = [];
        //             if (count($qst) > 0) {


        //                 for ($j = 0; $j < count($qst); $j++) {
        //                     $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$qst[$j]->question_id}' ORDER BY question_id ASC")->result();
        //                     if (count($data_reponses) > 0) {
        //                         $qst[$j]->reponses = $data_reponses;
        //                     }
        //                     array_push($array_questions, $qst[$j]);
        //                 }
        //             }

        //             $section[$i]->questions = $array_questions;
        //             break;
        //         case "Les institutions européennes":
        //             $qst = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre='{$date}' ORDER BY question_id ASC")->result();
        //             $array_questions = [];
        //             if (count($qst) > 0) {


        //                 for ($j = 0; $j < count($qst); $j++) {
        //                     $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$qst[$j]->question_id}' ORDER BY question_id ASC")->result();
        //                     if (count($data_reponses) > 0) {
        //                         $qst[$j]->reponses = $data_reponses;
        //                     }
        //                     array_push($array_questions, $qst[$j]);
        //                 }
        //             }


        //             $section[$i]->questions = $array_questions;
        //             break;
        //         case "Culture numérique":
        //             $qst = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre='{$date}' ORDER BY question_id ASC")->result();
        //             $array_questions = [];
        //             if (count($qst) > 0) {


        //                 for ($j = 0; $j < count($qst); $j++) {
        //                     $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$qst[$j]->question_id}' ORDER BY question_id ASC")->result();
        //                     if (count($data_reponses) > 0) {
        //                         $qst[$j]->reponses = $data_reponses;
        //                     }
        //                     array_push($array_questions, $qst[$j]);
        //                 }
        //             }


        //             $section[$i]->questions = $array_questions;
        //             break;
        //     }
        // }





        // return $section;


        for ($i = 0; $i < count($section); $i++) {
            switch ($section[$i]->section_nom) {
                case "Culture générale":

                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre='{$date}' ORDER BY question_id ASC")->result();

                    $array_questions = [];
                    if (count($data2020_0) > 0) {


                        for ($j = 0; $j < count($data2020_0); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2020_0[$j]->question_id}' ORDER BY question_id ASC")->result();

                            if (count($data_reponses) > 0) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                $data2020_0[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $data2020_0[$j]);
                        }
                    }


                    $section[$i]->questions = $array_questions;

                    break;
                case "Français":
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre='{$date}' ORDER BY question_id ASC")->result();

                    $array_questions = [];
                    if (count($data2020_0) > 0) {


                        for ($j = 0; $j < count($data2020_0); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2020_0[$j]->question_id}' ORDER BY question_id ASC")->result();
                            if (count($data_reponses) > 0) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                $data2020_0[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $data2020_0[$j]);
                        }
                    }


                    $section[$i]->questions = $array_questions;
                    break;
                case "Logique":
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre='{$date}' ORDER BY question_id ASC")->result();

                    $array_questions = [];
                    if (count($data2020_0) > 0) {


                        for ($j = 0; $j < count($data2020_0); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2020_0[$j]->question_id}' ORDER BY question_id ASC")->result();
                            if (count($data_reponses) > 0) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                $data2020_0[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $data2020_0[$j]);
                        }
                    }


                    $section[$i]->questions = $array_questions;
                    break;
                case "Mathématiques":
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre='{$date}' ORDER BY question_id ASC")->result();

                    $array_questions = [];
                    if (count($data2020_0) > 0) {


                        for ($j = 0; $j < count($data2020_0); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2020_0[$j]->question_id}' ORDER BY question_id ASC")->result();
                            if (count($data_reponses) > 0) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                $data2020_0[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $data2020_0[$j]);
                        }
                    }


                    $section[$i]->questions = $array_questions;
                    break;
            }
        }
        // Ordre: Francais, culture g, maths, logiques
        $newSection = [$section[2], $section[3], $section[1], $section[0]];

        return $newSection;
    }

    public function fetchCFipuLastest()
    {
        $date = "Année 2023";
        $section = $this->db->query("SELECT * FROM section WHERE categorie_id='23'")->result();
        // for ($i = 0; $i < count($section); $i++) {
        //     switch ($section[$i]->section_nom) {
        //         case "Culture administrative et juridique":
        //             $qst = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre='{$date}' ORDER BY question_id ASC")->result();
        //             $array_questions = [];
        //             if (count($qst) > 0) {


        //                 for ($j = 0; $j < count($qst); $j++) {
        //                     $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$qst[$j]->question_id}' ORDER BY question_id ASC")->result();
        //                     if (count($data_reponses) > 0) {
        //                         $qst[$j]->reponses = $data_reponses;
        //                     }
        //                     array_push($array_questions, $qst[$j]);
        //                 }
        //             }


        //             $section[$i]->questions = $array_questions;

        //             break;
        //         case "Finances publiques":

        //             $qst = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre='{$date}' ORDER BY question_id ASC")->result();
        //             $array_questions = [];
        //             if (count($qst) > 0) {


        //                 for ($j = 0; $j < count($qst); $j++) {
        //                     $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$qst[$j]->question_id}' ORDER BY question_id ASC")->result();
        //                     if (count($data_reponses) > 0) {
        //                         $qst[$j]->reponses = $data_reponses;
        //                     }
        //                     array_push($array_questions, $qst[$j]);
        //                 }
        //             }

        //             $section[$i]->questions = $array_questions;
        //             break;
        //         case "Les institutions européennes":
        //             $qst = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre='{$date}' ORDER BY question_id ASC")->result();
        //             $array_questions = [];
        //             if (count($qst) > 0) {


        //                 for ($j = 0; $j < count($qst); $j++) {
        //                     $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$qst[$j]->question_id}' ORDER BY question_id ASC")->result();
        //                     if (count($data_reponses) > 0) {
        //                         $qst[$j]->reponses = $data_reponses;
        //                     }
        //                     array_push($array_questions, $qst[$j]);
        //                 }
        //             }


        //             $section[$i]->questions = $array_questions;
        //             break;
        //         case "Culture numérique":
        //             $qst = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre='{$date}' ORDER BY question_id ASC")->result();
        //             $array_questions = [];
        //             if (count($qst) > 0) {


        //                 for ($j = 0; $j < count($qst); $j++) {
        //                     $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$qst[$j]->question_id}' ORDER BY question_id ASC")->result();
        //                     if (count($data_reponses) > 0) {
        //                         $qst[$j]->reponses = $data_reponses;
        //                     }
        //                     array_push($array_questions, $qst[$j]);
        //                 }
        //             }


        //             $section[$i]->questions = $array_questions;
        //             break;
        //     }
        // }





        // return $section;


        for ($i = 0; $i < count($section); $i++) {
            switch ($section[$i]->section_nom) {
                case "Culture générale":

                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre='{$date}' ORDER BY question_id ASC")->result();

                    $array_questions = [];
                    if (count($data2020_0) > 0) {


                        for ($j = 0; $j < count($data2020_0); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2020_0[$j]->question_id}' ORDER BY question_id ASC")->result();

                            if (count($data_reponses) > 0) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                $data2020_0[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $data2020_0[$j]);
                        }
                    }


                    $section[$i]->questions = $array_questions;

                    break;
                case "Français":
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre='{$date}' ORDER BY question_id ASC")->result();

                    $array_questions = [];
                    if (count($data2020_0) > 0) {


                        for ($j = 0; $j < count($data2020_0); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2020_0[$j]->question_id}' ORDER BY question_id ASC")->result();
                            if (count($data_reponses) > 0) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                $data2020_0[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $data2020_0[$j]);
                        }
                    }


                    $section[$i]->questions = $array_questions;
                    break;
                case "Logique":
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre='{$date}' ORDER BY question_id ASC")->result();

                    $array_questions = [];
                    if (count($data2020_0) > 0) {


                        for ($j = 0; $j < count($data2020_0); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2020_0[$j]->question_id}' ORDER BY question_id ASC")->result();
                            if (count($data_reponses) > 0) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                $data2020_0[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $data2020_0[$j]);
                        }
                    }


                    $section[$i]->questions = $array_questions;
                    break;
                case "Mathématiques":
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}' AND titre='{$date}' ORDER BY question_id ASC")->result();

                    $array_questions = [];
                    if (count($data2020_0) > 0) {


                        for ($j = 0; $j < count($data2020_0); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$data2020_0[$j]->question_id}' ORDER BY question_id ASC")->result();
                            if (count($data_reponses) > 0) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                $data2020_0[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $data2020_0[$j]);
                        }
                    }


                    $section[$i]->questions = $array_questions;
                    break;
            }
        }
        // var_dump($section) ;
        // die() ;
        // Ordre: Francais, culture g, maths, logiques
        $newSection = [$section[1], $section[3], $section[0], $section[2]];

        return $newSection;
    }

    public function fetchAFipuSession($code)
    {
        // cg 15, fr 16, log 10, maths 13
        $the_code = $code;
        $the_datas = $this->db->query("SELECT * FROM session_saves WHERE the_code='$code'")->result();
        $questions = json_decode($the_datas[0]->the_datas);


        $section = $this->db->query("SELECT * FROM section WHERE categorie_id='22'")->result();
        for ($i = 0; $i < count($section); $i++) {
            switch ($section[$i]->section_nom) {
                case "Culture générale":

                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}'")->result();

                    $newData = [];
                    $array_questions = [];
                    if (count($data2020_0) > 0) {
                        // for ($j = 0; $j < count($data2020_0); $j++) {
                        for ($r = 0; $r < count($data2020_0); $r++) {
                            if (in_array($data2020_0[$r]->question_id, $questions)) {
                                array_push($newData, $data2020_0[$r]);
                            }
                        }

                        for ($j = 0; $j < count($newData); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$newData[$j]->question_id}' ORDER BY RAND() LIMIT 7")->result();
                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                $newData[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $newData[$j]);
                        }
                        // }
                    }


                    $section[$i]->questions = $array_questions;

                    break;
                case "Français":
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}'")->result();

                    $newData = [];
                    $array_questions = [];
                    if (count($data2020_0) > 0) {
                        // for ($j = 0; $j < count($data2020_0); $j++) {

                        for ($r = 0; $r < count($data2020_0); $r++) {
                            if (in_array($data2020_0[$r]->question_id, $questions)) {
                                array_push($newData, $data2020_0[$r]);
                            }
                        }


                        for ($j = 0; $j < count($newData); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$newData[$j]->question_id}' ORDER BY RAND() LIMIT 7")->result();
                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }

                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                $newData[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $newData[$j]);
                        }
                        // }
                    }


                    $section[$i]->questions = $array_questions;


                    break;
                case "Logique":
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}'")->result();

                    $newData = [];
                    $array_questions = [];
                    if (count($data2020_0) > 0) {
                        // for ($j = 0; $j < count($data2020_0); $j++) {

                        for ($r = 0; $r < count($data2020_0); $r++) {
                            if (in_array($data2020_0[$r]->question_id, $questions)) {
                                array_push($newData, $data2020_0[$r]);
                            }
                        }

                        for ($j = 0; $j < count($newData); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$newData[$j]->question_id}' ORDER BY RAND() LIMIT 7")->result();
                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                $newData[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $newData[$j]);
                        }
                        // }
                    }


                    $section[$i]->questions = $array_questions;

                    break;
                case "Mathématiques":
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}'")->result();

                    $newData = [];
                    $array_questions = [];
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}'")->result();

                    $newData = [];
                    $array_questions = [];
                    if (count($data2020_0) > 0) {
                        // for ($j = 0; $j < count($data2020_0); $j++) {

                        for ($r = 0; $r < count($data2020_0); $r++) {
                            if (in_array($data2020_0[$r]->question_id, $questions)) {
                                array_push($newData, $data2020_0[$r]);
                            }
                        }

                        for ($j = 0; $j < count($newData); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$newData[$j]->question_id}' ORDER BY RAND() LIMIT 7")->result();
                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                $newData[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $newData[$j]);
                        }
                        // }
                    }


                    $section[$i]->questions = $array_questions;

                    break;
            }
        }

        $newSection = [$section[2], $section[3], $section[1], $section[0]];

        $section = $this->db->query("SELECT * FROM section WHERE categorie_id='28'")->result();
        for ($i = 0; $i < count($section); $i++) {
            switch ($section[$i]->section_nom) {
                case "Culture générale":

                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}'")->result();

                    $newData = [];
                    $array_questions = [];
                    if (count($data2020_0) > 0) {
                        // for ($j = 0; $j < count($data2020_0); $j++) {

                        for ($r = 0; $r < count($data2020_0); $r++) {
                            if (in_array($data2020_0[$r]->question_id, $questions)) {
                                array_push($newData, $data2020_0[$r]);
                            }
                        }

                        for ($j = 0; $j < count($newData); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$newData[$j]->question_id}' ORDER BY RAND() LIMIT 7")->result();
                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                $newData[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $newData[$j]);
                        }
                        // }
                    }


                    $section[$i]->questions = $array_questions;

                    break;
                case "Français":
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}'")->result();

                    $newData = [];
                    $array_questions = [];
                    if (count($data2020_0) > 0) {
                        // for ($j = 0; $j < count($data2020_0); $j++) {

                        for ($r = 0; $r < count($data2020_0); $r++) {
                            if (in_array($data2020_0[$r]->question_id, $questions)) {
                                array_push($newData, $data2020_0[$r]);
                            }
                        }

                        for ($j = 0; $j < count($newData); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$newData[$j]->question_id}' ORDER BY RAND() LIMIT 7")->result();
                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                $newData[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $newData[$j]);
                        }
                        // }
                    }


                    $section[$i]->questions = $array_questions;

                    break;
                case "Logique":
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}'")->result();

                    $newData = [];
                    $array_questions = [];
                    if (count($data2020_0) > 0) {
                        // for ($j = 0; $j < count($data2020_0); $j++) {

                        for ($r = 0; $r < count($data2020_0); $r++) {
                            if (in_array($data2020_0[$r]->question_id, $questions)) {
                                array_push($newData, $data2020_0[$r]);
                            }
                        }

                        for ($j = 0; $j < count($newData); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$newData[$j]->question_id}' ORDER BY RAND() LIMIT 7")->result();
                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                $newData[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $newData[$j]);
                        }
                        // }
                    }


                    $section[$i]->questions = $array_questions;

                    break;
                case "Mathématiques":
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}'")->result();

                    $newData = [];
                    $array_questions = [];
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}'")->result();

                    $newData = [];
                    $array_questions = [];
                    if (count($data2020_0) > 0) {
                        // for ($j = 0; $j < count($data2020_0); $j++) {

                        for ($r = 0; $r < count($data2020_0); $r++) {
                            if (in_array($data2020_0[$r]->question_id, $questions)) {
                                array_push($newData, $data2020_0[$r]);
                            }
                        }

                        for ($j = 0; $j < count($newData); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$newData[$j]->question_id}' ORDER BY RAND() LIMIT 7")->result();
                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                $newData[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $newData[$j]);
                        }
                        // }
                    }


                    $section[$i]->questions = $array_questions;

                    break;
            }
        }

        // $newSection = [$section_body[1], $section_body[0], $section_body[2], $section_body[3]];
        // Ordre: Francais, culture g, maths, logiques
        
        for ($k = 0; $k < count($section[1]->questions); $k++) {
            $aa = $section[1]->questions;
            array_push($newSection[0]->questions, $aa[$k]);
        }
        for ($k = 0; $k < count($section[0]->questions); $k++) {
            $aa = $section[0]->questions;
            array_push($newSection[1]->questions, $aa[$k]);
        }
        for ($k = 0; $k < count($section[2]->questions); $k++) {
            $aa = $section[2]->questions;
            array_push($newSection[2]->questions, $aa[$k]);
        }
        for ($k = 0; $k < count($section[3]->questions); $k++) {
            $aa = $section[3]->questions;
            array_push($newSection[3]->questions, $aa[$k]);
        }

        
        return $newSection;
    }
    public function fetchCFipuSession($code)
    {
        // cg 15, fr 16, log 10, maths 13
        $the_code = $code;
        $the_datas = $this->db->query("SELECT * FROM session_saves WHERE the_code='$code'")->result();
        $questions = json_decode($the_datas[0]->the_datas);
        $section = $this->db->query("SELECT * FROM section WHERE categorie_id='23'")->result();
        for ($i = 0; $i < count($section); $i++) {
            switch ($section[$i]->section_nom) {
                case "Culture générale":

                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}'")->result();

                    $newData = [];
                    $array_questions = [];
                    // $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}'")->result();

                    if (count($data2020_0) > 0) {
                        // for ($j = 0; $j < count($data2020_0); $j++) {

                        for ($r = 0; $r < count($data2020_0); $r++) {
                            if (in_array($data2020_0[$r]->question_id, $questions)) {
                                array_push($newData, $data2020_0[$r]);
                            }
                        }
                        for ($j = 0; $j < count($newData); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$newData[$j]->question_id}' ORDER BY RAND() LIMIT 7")->result();
                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                $newData[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $newData[$j]);
                        }
                        // }
                    }


                    $section[$i]->questions = $array_questions;

                    break;
                case "Français":
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}'")->result();

                    $newData = [];
                    $array_questions = [];
                    if (count($data2020_0) > 0) {
                        // for ($j = 0; $j < count($data2020_0); $j++) {

                        for ($r = 0; $r < count($data2020_0); $r++) {
                            if (in_array($data2020_0[$r]->question_id, $questions)) {
                                array_push($newData, $data2020_0[$r]);
                            }
                        }
                        for ($j = 0; $j < count($newData); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$newData[$j]->question_id}' ORDER BY RAND() LIMIT 7")->result();
                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                $newData[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $newData[$j]);
                        }
                        // }
                    }


                    $section[$i]->questions = $array_questions;

                    break;
                case "Logique":
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}'")->result();

                    $newData = [];
                    $array_questions = [];
                    if (count($data2020_0) > 0) {
                        // for ($j = 0; $j < count($data2020_0); $j++) {

                        for ($r = 0; $r < count($data2020_0); $r++) {
                            if (in_array($data2020_0[$r]->question_id, $questions)) {
                                array_push($newData, $data2020_0[$r]);
                            }
                        }
                        for ($j = 0; $j < count($newData); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$newData[$j]->question_id}' ORDER BY RAND() LIMIT 7")->result();
                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                $newData[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $newData[$j]);
                        }
                        // }
                    }


                    $section[$i]->questions = $array_questions;

                    break;
                case "Mathématiques":
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}'")->result();

                    $newData = [];
                    $array_questions = [];
                    if (count($data2020_0) > 0) {
                        // for ($j = 0; $j < count($data2020_0); $j++) {

                        for ($r = 0; $r < count($data2020_0); $r++) {
                            if (in_array($data2020_0[$r]->question_id, $questions)) {
                                array_push($newData, $data2020_0[$r]);
                            }
                        }
                        for ($j = 0; $j < count($newData); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$newData[$j]->question_id}' ORDER BY RAND() LIMIT 7")->result();
                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                $newData[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $newData[$j]);
                        }
                        // }
                    }


                    $section[$i]->questions = $array_questions;

                    break;
            }
        }
        // Ordre: Francais, culture g, maths, logiques
        $newSection = [$section[2], $section[3], $section[1], $section[0]];

        $section = $this->db->query("SELECT * FROM section WHERE categorie_id='28'")->result();
        for ($i = 0; $i < count($section); $i++) {
            switch ($section[$i]->section_nom) {
                case "Culture générale":

                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}'")->result();

                    $newData = [];
                    $array_questions = [];
                    if (count($data2020_0) > 0) {
                        // for ($j = 0; $j < count($data2020_0); $j++) {

                        for ($r = 0; $r < count($data2020_0); $r++) {
                            if (in_array($data2020_0[$r]->question_id, $questions)) {
                                array_push($newData, $data2020_0[$r]);
                            }
                        }
                        for ($j = 0; $j < count($newData); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$newData[$j]->question_id}' ORDER BY RAND() LIMIT 7")->result();
                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                $newData[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $newData[$j]);
                        }
                        // }
                    }


                    $section[$i]->questions = $array_questions;

                    break;
                case "Français":
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}'")->result();

                    $newData = [];
                    $array_questions = [];
                    if (count($data2020_0) > 0) {
                        // for ($j = 0; $j < count($data2020_0); $j++) {

                        for ($r = 0; $r < count($data2020_0); $r++) {
                            if (in_array($data2020_0[$r]->question_id, $questions)) {
                                array_push($newData, $data2020_0[$r]);
                            }
                        }
                        for ($j = 0; $j < count($newData); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$newData[$j]->question_id}' ORDER BY RAND() LIMIT 7")->result();
                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                $newData[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $newData[$j]);
                        }
                        // }
                    }


                    $section[$i]->questions = $array_questions;

                    break;
                case "Logique":
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}'")->result();

                    $newData = [];
                    $array_questions = [];
                    if (count($data2020_0) > 0) {
                        // for ($j = 0; $j < count($data2020_0); $j++) {

                        for ($r = 0; $r < count($data2020_0); $r++) {
                            if (in_array($data2020_0[$r]->question_id, $questions)) {
                                array_push($newData, $data2020_0[$r]);
                            }
                        }
                        for ($j = 0; $j < count($newData); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$newData[$j]->question_id}' ORDER BY RAND() LIMIT 7")->result();
                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                $newData[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $newData[$j]);
                        }
                        // }
                    }


                    $section[$i]->questions = $array_questions;

                    break;
                case "Mathématiques":
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}'")->result();

                    $newData = [];
                    $array_questions = [];
                    $data2020_0 = $this->db->query("SELECT * FROM question WHERE section_id='{$section[$i]->section_id}'")->result();

                    $newData = [];
                    $array_questions = [];
                    if (count($data2020_0) > 0) {
                        // for ($j = 0; $j < count($data2020_0); $j++) {

                        for ($r = 0; $r < count($data2020_0); $r++) {
                            if (in_array($data2020_0[$r]->question_id, $questions)) {
                                array_push($newData, $data2020_0[$r]);
                            }
                        }
                        for ($j = 0; $j < count($newData); $j++) {
                            $data_reponses = $this->db->query("SELECT * FROM reponse WHERE question_id='{$newData[$j]->question_id}' ORDER BY RAND() LIMIT 7")->result();
                            if (count($data_reponses) > 0 && (count($data_reponses) == 7)) {

                                $newArray = [];
                                $T = [];
                                $A = [];
                                $O = [];
                                for ($aa = 0; $aa < count($data_reponses); $aa++) {
                                    if ($data_reponses[$aa]->reponse_contenu == "T - Toutes les réponses sont correctes") {
                                        array_push($T, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "A - Aucune des réponses n’est correcte") {
                                        array_push($A, $data_reponses[$aa]);
                                    } else if ($data_reponses[$aa]->reponse_contenu == "O - Omission") {
                                        array_push($O, $data_reponses[$aa]);
                                    } else {
                                        array_push($newArray, $data_reponses[$aa]);
                                    }
                                }
                                if ($this->getStateVersion() == 'on') {
                                    array_push($newArray, $T[0]);
                                    array_push($newArray, $A[0]);
                                    array_push($newArray, $O[0]);
                                }
                                $newData[$j]->reponses = $newArray;
                            }
                            array_push($array_questions, $newData[$j]);
                        }
                        // }
                    }


                    $section[$i]->questions = $array_questions;

                    break;
            }
        }

        // $newSection = [$section_body[1], $section_body[0], $section_body[2], $section_body[3]];
        // Ordre: Francais, culture g, maths, logiques

        for ($k = 0; $k < count($section[1]->questions); $k++) {
            $aa = $section[1]->questions;
            array_push($newSection[2]->questions, $aa[$k]);
        }
        for ($k = 0; $k < count($section[0]->questions); $k++) {
            $aa = $section[0]->questions;
            array_push($newSection[3]->questions, $aa[$k]);
        }
        for ($k = 0; $k < count($section[2]->questions); $k++) {
            $aa = $section[2]->questions;
            array_push($newSection[1]->questions, $aa[$k]);
        }
        for ($k = 0; $k < count($section[3]->questions); $k++) {
            $aa = $section[3]->questions;
            array_push($newSection[0]->questions, $aa[$k]);
        }


        return $newSection;
    }
}
