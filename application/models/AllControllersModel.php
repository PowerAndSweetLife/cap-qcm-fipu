<?php
class AllControllersModel extends CI_Model
{
    public function getuserByEmail($mail, $user_type)
    {
        $data = $this->db->query("SELECT * FROM clients WHERE email='{$mail}' AND user_type='{$user_type}'")->result();
        return $data;
    }

    public function insertUser($pseudo,$email,$user_type) {
        $this->db->query("INSERT INTO clients(pseudo,email,user_type,created_at) VALUES('{$pseudo}','{$email}','{$user_type}','".date('d-m-Y')."')") ;
    }

    public function saveHistoryToDb($email, $data)
    {
        $this->db->query("INSERT INTO session_history(clients_id,data_history,date_history,type) VALUES('" . $email . "','" . $data . "','" . date("Y-m-d h:m:s") . "','fipu')");
    }

    public function getUserSessionHistory($email)
    {
        $data = $this->db->query("SELECT * FROM session_history WHERE clients_id='{$email}' AND type='fipu' ORDER BY id ASC")->result();
        return $data;
    }

    public function addFav($id, $email)
    {
        $this->db->query("INSERT INTO favoris(question_id,clients_id,type) VALUES('{$id}','{$email}','fipu')");
    }

    public function getRevisionCFipu($email)
    {
        $data = $this->db->query("SELECT * FROM favoris WHERE clients_id='{$email}' AND type='fipu' ORDER BY id_favoris ASC")->result();
        return $data;
    }
    public function getRevisionAFipu($email)
    {
        $data = $this->db->query("SELECT * FROM favoris WHERE clients_id='{$email}' AND type='fipu' ORDER BY id_favoris ASC")->result();
        return $data;
    }
    public function removeFav($id, $email)
    {
        $this->db->query("DELETE FROM favoris WHERE clients_id='{$email}' AND type='fipu' AND question_id='{$id}'");
    }

    public function addHistoriqueSession($id, $date)
    {
        $this->db->query("INSERT INTO historique_session(id_user,date_session) VALUES('$id','$date')");
    }

    public function getAllHistoriqueSession($id)
    {
        return $this->db->query("SELECT * FROM historique_session WHERE id_user='{$id}'")->result();
    }
    public function doPointage($id, $date)
    {
        $this->db->query("UPDATE clients SET last_use='{$date}' WHERE id='{$id}'");
    }

    public function register_session($code_data,$code,$type,$id,$date) {
        $this->db->query("INSERT INTO session_saves(the_datas,the_code,the_type,client_id,the_date) VALUES('$code_data','$code','$type','$id','$date')") ;
    }
    public function verify_code_session($code) {
        return $this->db->query("SELECT * FROM session_saves WHERE the_code='$code' AND the_type='fipu'")->result() ;
    }
}
