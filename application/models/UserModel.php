<?php
    class UserModel extends CI_Model {
        public function getUserByEmail($email) {
            return $this->db->query("SELECT * FROM user WHERE email='{$email}'")->result() ;
        }

        public function insertUtilisation($date,$second,$id,$label) {
            $req = "INSERT INTO utilisation(id_user,date_utilisation,hour_utilisation,label) VALUES('$id','$date','$second','$label')" ;
            $this->db->query($req) ;
        }

        public function getUtilisationLatestByID($id) {
            $req = "SELECT * FROM utilisation WHERE id_user='$id' ORDER BY id_uuid DESC" ;
            return $this->db->query($req)->result() ;
        }

        public function insertHistoryUtilisation($id,$total_time) {
            $date_now = date("Y-m-d") ;
            $req = "INSERT INTO historique_utilisation(id_user,total_time, date_utilisation) VALUES('$id','$total_time','$date_now')" ;
            $this->db->query($req) ;
        }
        public function deleteHistoryUtilisation($id) {
            $this->db->query("DELETE FROM utilisation WHERE id_user='$id'") ;
        }
    }