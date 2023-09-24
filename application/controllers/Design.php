<?php
class Design extends CI_Controller
{
    public function index()
    {
        if (isset($_SESSION['pseudo'])) {
            redirect("AllControllers/connect");
        } else {
            $this->load->view('template/header');
            $this->load->view('design');
            $this->load->view('template/footer', array('design' => 'disclaimer')) ;
        }
    }
}
