<?php
class AllControllers extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("AllControllersModel", "AllControllers");
        $this->load->model("FetcherModel", "Fetcher");
        $this->load->model("UserModel", "user_model");
    }

    public function register()
    {
        $pseudo = $this->input->post('pseudo');
        $email = $this->input->post('email');




        $user_type = "fipu";
        if (trim($pseudo) == "" || trim($email) == "") {
            $this->load->view('template/header');
            $this->load->view('design');
            $this->load->view('template/footer', array('design' => 'disclaimer'));
        } else {
            $data_res = $this->AllControllers->getuserByEmail($email, $user_type);

            if (count($data_res) == 0) {
                $this->AllControllers->insertUser($pseudo, $email, $user_type);
                $data = $this->AllControllers->getuserByEmail($email, $user_type);
                $sess = array(
                    'pseudo'  => $data[0]->pseudo,
                    'email'     => $data[0]->email,
                    'id'     => $data[0]->id,
                );
                $this->pointage();
                $this->session->set_userdata($sess);

                $date = date('Y-m-d');
                $second = date('H:i:s');

                $this->user_model->insertUtilisation($date, $second, $this->session->userdata('id'), "entree");



                $data_evolution = '';
                $total_evolution = 0;
                $evolution = $this->AllControllers->getUserSessionHistory($this->session->userdata('email'));
                for ($a = 0; $a < count($evolution); $a++) {
                    $total_evolution = count($evolution);
                    if ($data_evolution == '') {
                        $data_evolution .= $evolution[$a]->data_history;
                    } else {
                        $data_evolution .= "#" . $evolution[$a]->data_history;
                    }
                }



                $this->load->view('template/header');
                $this->load->view('parametters', array('session' => $data_evolution, 'session_total' => $total_evolution));
                $this->load->view('template/footer', array("active" => 'begin'));

                // $this->load->view('template/header');
                // $this->load->view('parametters');
                // $this->load->view('template/footer', array("active" => 'begin'));
            } else {
                $this->load->view('template/header');
                $this->load->view('design');
                $this->load->view('template/footer', array('design' => 'disclaimer'));
            }
        }
    }

    public function begin()
    {
        $this->__auth();
        $categorie = $this->input->post('categorie') ?? '';
        $mode = $this->input->post('mode') ?? '';
        $section = $this->input->post('section') ?? '';
        $executionTime = $this->input->post('executionTime') ?? '';
        $chrono = $this->input->post('chrono') ?? '';
        $countdown = $this->input->post('countdown') ?? '';
        $isNote = $this->input->post('isNote') ?? '';
        $bonneReponse = $this->input->post('bonneReponse') ?? '';
        $mauvaiseReponse = $this->input->post('mauvaiseReponse') ?? '';
        $absenceReponse = $this->input->post('absenceReponse') ?? '';
        $temps = $this->input->post('temps') ?? '';

        if ($this->input->post('code') != "") {

            if($categorie == "agent-fipu") {
                $res = $this->Fetcher->fetchAFipuSession($this->input->post('code'));
            }
            else if($categorie == "c-fipu") {
                $res = $this->Fetcher->fetchCFipuSession($this->input->post('code'));
            }

            


            $data_evolution = '';
            $total_evolution = 0;
            $evolution = $this->AllControllers->getUserSessionHistory($this->session->userdata('email'));
            for ($a = 0; $a < count($evolution); $a++) {
                $total_evolution = count($evolution);
                if ($data_evolution == '') {
                    $data_evolution .= $evolution[$a]->data_history;
                } else {
                    $data_evolution .= "#" . $evolution[$a]->data_history;
                }
            }

            $data = array(
                'categorie' => $categorie,
                'mode' => $mode,
                'section' => $section,
                // 'section' => 'Culture administrative et juridique' ,
                'temps' => $executionTime,
                'chrono' => $chrono,
                'retardateur' => $countdown,
                'note' => $isNote,
                'bonneReponse' => $bonneReponse,
                'mauvaiseReponse' => $mauvaiseReponse,
                'absenceReponse' => $absenceReponse,
                'donnees_qcm' => $res,
                'temps' => $temps,
                'access' => 'logged',
                'session' => $data_evolution,
                'session_total' => $total_evolution,
            );

            $date = date('Y-m-d');
            $second = date('H:i:s');
            $this->pointage();
            $this->user_model->insertUtilisation($date, $second, $this->session->userdata('id'), "entree");

            $this->load->view('template/header');
            $this->load->view('qcm', $data);
            $this->load->view('template/footer', array("active" => 'begin', 'timer' => 'timer'));
        } else {
            if ($categorie == "agent-fipu") {
                $res = $this->Fetcher->fetchAFipu();


                $data_evolution = '';
                $total_evolution = 0;
                $evolution = $this->AllControllers->getUserSessionHistory($this->session->userdata('email'));
                for ($a = 0; $a < count($evolution); $a++) {
                    $total_evolution = count($evolution);
                    if ($data_evolution == '') {
                        $data_evolution .= $evolution[$a]->data_history;
                    } else {
                        $data_evolution .= "#" . $evolution[$a]->data_history;
                    }
                }

                $data = array(
                    'categorie' => $categorie,
                    'mode' => $mode,
                    'section' => $section,
                    // 'section' => 'Culture administrative et juridique' ,
                    'temps' => $executionTime,
                    'chrono' => $chrono,
                    'retardateur' => $countdown,
                    'note' => $isNote,
                    'bonneReponse' => $bonneReponse,
                    'mauvaiseReponse' => $mauvaiseReponse,
                    'absenceReponse' => $absenceReponse,
                    'donnees_qcm' => $res,
                    'temps' => $temps,
                    'access' => 'logged',
                    'session' => $data_evolution,
                    'session_total' => $total_evolution,
                );

                $date = date('Y-m-d');
                $second = date('H:i:s');
                $this->pointage();
                $this->user_model->insertUtilisation($date, $second, $this->session->userdata('id'), "entree");

                $this->load->view('template/header');
                $this->load->view('qcm', $data);
                $this->load->view('template/footer', array("active" => 'begin', 'timer' => 'timer'));
            } else if ($categorie == "c-fipu") {
                $res = $this->Fetcher->fetchCFipu();


                $data_evolution = '';
                $total_evolution = 0;
                $evolution = $this->AllControllers->getUserSessionHistory($this->session->userdata('email'));
                for ($a = 0; $a < count($evolution); $a++) {
                    $total_evolution = count($evolution);
                    if ($data_evolution == '') {
                        $data_evolution .= $evolution[$a]->data_history;
                    } else {
                        $data_evolution .= "#" . $evolution[$a]->data_history;
                    }
                }

                $data = array(
                    'categorie' => $categorie,
                    'mode' => $mode,
                    'section' => $section,
                    // 'section' => 'Culture administrative et juridique' ,
                    'temps' => $executionTime,
                    'chrono' => $chrono,
                    'retardateur' => $countdown,
                    'note' => $isNote,
                    'bonneReponse' => $bonneReponse,
                    'mauvaiseReponse' => $mauvaiseReponse,
                    'absenceReponse' => $absenceReponse,
                    'donnees_qcm' => $res,
                    'temps' => $temps,
                    'access' => 'logged',
                    'session' => $data_evolution,
                    'session_total' => $total_evolution,
                );

                $date = date('Y-m-d');
                $second = date('H:i:s');
                $this->pointage();
                $this->user_model->insertUtilisation($date, $second, $this->session->userdata('id'), "entree");

                $this->load->view('template/header');
                $this->load->view('qcm', $data);
                $this->load->view('template/footer', array("active" => 'begin', 'timer' => 'timer'));
            }
        }
    }


    public function getHistory()
    {


        $data_evolution = '';
        $total_evolution = 0;
        $evolution = $this->AllControllers->getUserSessionHistory($this->session->userdata('email'));
        for ($a = 0; $a < count($evolution); $a++) {
            $total_evolution = count($evolution);
            if ($data_evolution == '') {
                $data_evolution .= $evolution[$a]->data_history;
            } else {
                $data_evolution .= "#" . $evolution[$a]->data_history;
            }
        }

        echo json_encode([$total_evolution, $data_evolution]);
    }

    public function connect()
    {
        // $this->__auth() ;
        // session_destroy() ;
        $user_type = "fipu";
        $email = trim($this->input->post('email'));
        if ($email == "") {
            // redirect("/") ;

            $this->load->view('template/header');
            $this->load->view('design');
            $this->load->view('template/footer', array('design' => 'disclaimer'));
        } else {
            $data = $this->AllControllers->getuserByEmail($email, $user_type);


            $data_evolution = '';
            $total_evolution = 0;
            $evolution = $this->AllControllers->getUserSessionHistory($email);
            for ($a = 0; $a < count($evolution); $a++) {
                $total_evolution = count($evolution);
                if ($data_evolution == '') {
                    $data_evolution .= $evolution[$a]->data_history;
                } else {
                    $data_evolution .= "#" . $evolution[$a]->data_history;
                }
            }

            if (count($data) > 0) {
                $limit = $data[0]->limit_session;
                $sh = count($this->AllControllers->getAllHistoriqueSession($data[0]->id));
                if ((($limit > 0) && ($sh > $limit)) || ($limit == -1)) {
                    $this->load->view('template/header');
                    $this->load->view('design');
                    $this->load->view('template/footer', array('design' => 'disclaimer', 'error_must_pay' => true));
                } else {
                    $sess = array(
                        'pseudo'  => $data[0]->pseudo,
                        'email'     => $data[0]->email,
                        'id'     => $data[0]->id,
                    );

                    $this->session->set_userdata($sess);

                    $this->pointage();

                    $this->load->view('template/header');
                    $this->load->view('parametters', array('session' => $data_evolution, 'session_total' => $total_evolution));
                    $this->load->view('template/footer', array("active" => 'begin'));
                }
            } else {
                $this->load->view('template/header');
                $this->load->view('design');
                $this->load->view('template/footer', array('design' => 'disclaimer'));
            }
        }
    }

    public function enterParametters()
    {
        $this->__auth();

        $data_evolution = '';
        $total_evolution = 0;
        $evolution = $this->AllControllers->getUserSessionHistory($this->session->userdata('email'));
        for ($a = 0; $a < count($evolution); $a++) {
            $total_evolution = count($evolution);
            if ($data_evolution == '') {
                $data_evolution .= $evolution[$a]->data_history;
            } else {
                $data_evolution .= "#" . $evolution[$a]->data_history;
            }
        }



        $this->load->view('template/header');
        $this->load->view('parametters', array('session' => $data_evolution, 'session_total' => $total_evolution));
        $this->load->view('template/footer', array("active" => 'begin'));
    }


    public function __auth()
    {
        if (!isset($_SESSION['email']) && trim($_SESSION['email']) == "") {
            redirect("/");
            exit();
        }
    }

    public function deconnect()
    {

        $this->pointage();
        session_destroy();
        redirect("/");
    }

    public function send_email()
    {
        $this->load->library('email');

        $this->email->from($this->input->post('email'), $this->input->post('email'));
        $this->email->to('contact@cap-qcm.com');

        $this->email->subject($this->input->post('objet'));

        $this->email->message($this->input->post('text'));

        $this->email->send();
        redirect("/");
    }

    public function contribute()
    {
        $this->__auth();


        $this->load->library('email');

        $this->email->from($_SESSION['email'], $_SESSION['pseudo']);
        $this->email->to('contact@cap-qcm.com');

        $this->email->subject('Contribution');
        $txt = 'Catégorie: ' . $this->input->post('categorie') . "\n";
        // $txt .= '\r\n' ;
        $txt .= 'Question: ' . $this->input->post('question') . "\n";
        // $txt .= '\r\n' ;
        $txt .= 'Réponse 1: ' . $this->input->post('reponse_1') . "\n";
        // $txt .= '\r\n' ;
        $txt .= 'Réponse 2: ' . $this->input->post('reponse_2') . "\n";
        // $txt .= '\r\n' ;
        $txt .= 'Réponse 3: ' . $this->input->post('reponse_3') . "\n";
        // $txt .= '\r\n' ;

        $this->email->message($txt);

        $this->email->send();


        $data_evolution = '';
        $total_evolution = 0;
        $evolution = $this->AllControllers->getUserSessionHistory($this->session->userdata('email'));
        for ($a = 0; $a < count($evolution); $a++) {
            $total_evolution = count($evolution);
            if ($data_evolution == '') {
                $data_evolution .= $evolution[$a]->data_history;
            } else {
                $data_evolution .= "#" . $evolution[$a]->data_history;
            }
        }



        $this->load->view('template/header');
        $this->load->view('parametters', array('session' => $data_evolution, 'session_total' => $total_evolution));
        $this->load->view('template/footer', array("active" => 'begin'));


        // $this->load->view('template/header');
        // $this->load->view('parametters');
        // $this->load->view('template/footer', array("active" => 'begin'));
    }

    public function free_access()
    {
        $res = $this->Fetcher->fetchAFipuLastest();

        $data = array(
            'categorie' => '',
            'mode' => '',
            'section' => 'Français',
            // 'section' => 'Culture administrative et juridique' ,
            'temps' => '1:30',
            'chrono' => '',
            'retardateur' => '',
            'note' => 'non',
            'bonneReponse' => 0,
            'mauvaiseReponse' => 0,
            'absenceReponse' => 0,
            'donnees_qcm' => $res,
            'access' => 'free',
        );

        $this->load->view('template/header');
        $this->load->view('free_access', $data);
        $this->load->view('template/footer', array("active" => 'begin', 'timer' => 'timer'));
    }

    public function free_access_c()
    {
        $res = $this->Fetcher->fetchCFipuLastest();

        $data = array(
            'categorie' => '',
            'mode' => '',
            'section' => 'Français',
            // 'section' => 'Culture administrative et juridique' ,
            'temps' => '1:30',
            'chrono' => '',
            'retardateur' => '',
            'note' => 'non',
            'bonneReponse' => 0,
            'mauvaiseReponse' => 0,
            'absenceReponse' => 0,
            'donnees_qcm' => $res,
            'access' => 'free',
        );

        $this->load->view('template/header');
        $this->load->view('free_access', $data);
        $this->load->view('template/footer', array("active" => 'begin', 'timer' => 'timer'));
    }


    public function saveHistory()
    {

        $questionRepondue = $this->input->post('questionRepondue');
        $questionNonRepondue = $this->input->post('questionNonRepondue');
        $reponseJuste = $this->input->post('reponseJuste');
        $reponseFausse = $this->input->post('reponseFausse');

        $data = array("questionRepondue" => $questionRepondue, "questionNonRepondue" => $questionNonRepondue, "reponseJuste" => $reponseJuste, "reponseFausse" => $reponseFausse);

        $data_to_json = json_encode($data);

        $last = $this->user_model->getUtilisationLatestByID($this->session->userdata('id'));
        $date = date('Y-m-d');
        $second = date('H:i:s');
        $date1 = new DateTime($last[0]->date_utilisation . " " . $last[0]->hour_utilisation);
        $date2 = new DateTime(date('Y-m-d H:i:s'));
        $diff = $date1->diff($date2);
        $hours = $diff->days * 24 + $diff->h + ($diff->i / 60) + ($diff->s / 3600);
        $this->user_model->insertHistoryUtilisation($this->session->userdata('id'), $hours);
        $this->user_model->deleteHistoryUtilisation($this->session->userdata('id'));

        $this->AllControllers->saveHistoryToDb($this->session->userdata("email"), $data_to_json);
        $this->AllControllers->addHistoriqueSession($this->session->userdata('id'), date("Y-m-d"));

        echo "success";
    }


    public function addToFavorite()
    {

        $id = $this->input->post('id');

        $this->AllControllers->addFav($id, $this->session->userdata('email'));
        echo "added";
    }

    public function removeToFavorite()
    {
        $id = $this->input->post('id');
        $this->AllControllers->removeFav($id, $this->session->userdata('email'));
        echo 'removed';
    }

    public function revision($categ)
    {
        $this->__auth();
        $this->pointage();
        if ($categ == 'c-fipu') {
            $data_rev = $this->AllControllers->getRevisionCFipu($this->session->userdata('email'));
            if (count($data_rev) > 0) {


                $res = $this->Fetcher->getDataForRevisionCFipu($this->session->userdata('email'));

                $data = array(
                    'categorie' => '',
                    'mode' => '',
                    'section' => 'Français',
                    // 'section' => 'Culture administrative et juridique' ,
                    'temps' => '1:30',
                    'chrono' => '',
                    'retardateur' => '',
                    'note' => 'non',
                    'bonneReponse' => 0,
                    'mauvaiseReponse' => 0,
                    'absenceReponse' => 0,
                    'donnees_qcm' => $res,
                    'access' => 'free',
                );

                $this->load->view('template/header');
                $this->load->view('revision', $data);
                $this->load->view('template/footer', array('revision' => true));
            } else {
                $data_evolution = '';
                $total_evolution = 0;
                $evolution = $this->AllControllers->getUserSessionHistory($this->session->userdata('email'));
                for ($a = 0; $a < count($evolution); $a++) {
                    $total_evolution = count($evolution);
                    if ($data_evolution == '') {
                        $data_evolution .= $evolution[$a]->data_history;
                    } else {
                        $data_evolution .= "#" . $evolution[$a]->data_history;
                    }
                }



                $this->load->view('template/header');
                $this->load->view('parametters', array('session' => $data_evolution, 'session_total' => $total_evolution));
                $this->load->view('template/footer', array("active" => 'begin', 'favoris_not_exist' => true));
            }
        } else {
            $data_rev = $this->AllControllers->getRevisionAFipu($this->session->userdata('email'));
            if (count($data_rev) > 0) {


                $res = $this->Fetcher->getDataForRevisionAFipu($this->session->userdata('email'));

                $data = array(
                    'categorie' => '',
                    'mode' => '',
                    'section' => 'Français',
                    // 'section' => 'Culture administrative et juridique' ,
                    'temps' => '1:30',
                    'chrono' => '',
                    'retardateur' => '',
                    'note' => 'non',
                    'bonneReponse' => 0,
                    'mauvaiseReponse' => 0,
                    'absenceReponse' => 0,
                    'donnees_qcm' => $res,
                    'access' => 'free',
                );

                $this->load->view('template/header');
                $this->load->view('revision', $data);
                $this->load->view('template/footer', array('revision' => true));
            } else {
                $data_evolution = '';
                $total_evolution = 0;
                $evolution = $this->AllControllers->getUserSessionHistory($this->session->userdata('email'));
                for ($a = 0; $a < count($evolution); $a++) {
                    $total_evolution = count($evolution);
                    if ($data_evolution == '') {
                        $data_evolution .= $evolution[$a]->data_history;
                    } else {
                        $data_evolution .= "#" . $evolution[$a]->data_history;
                    }
                }



                $this->load->view('template/header');
                $this->load->view('parametters', array('session' => $data_evolution, 'session_total' => $total_evolution));
                $this->load->view('template/footer', array("active" => 'begin', 'favoris_not_exist' => true));
            }
        }
    }
    public function pointage()
    {
        $this->AllControllers->doPointage($this->session->userdata("id"), date("Y/m/d H:i:s"));
    }


    public function save_code()
    {
        $code_data = $this->input->post('code_data');
        $code = $this->generate_code();
        $type = "fipu";
        $id = $this->session->userdata('id');
        $date = date("Y-m-d H:i:s");

        // if($this->AllControllers->verify_code_session($code)) {
        //     $code = substr(md5(mt_rand()), 0, 5) ;
        // }
        $this->AllControllers->register_session($code_data, $code, $type, $id, $date);

        echo json_encode([
            "code" => $code,
            "success" => true
        ]);
    }

    public function generate_code()
    {
        return substr(md5(mt_rand()), 0, 10);
    }

    public function getSession()
    {
        $code = $this->input->post("code");
        $data_code = $this->AllControllers->verify_code_session($code);
        if (count($data_code) == 0) {
            echo "not_exists";
        } else {
            echo "exists";
        }
    }
}
