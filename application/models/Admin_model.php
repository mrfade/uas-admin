<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function getAdminById($id) {

        $query = $this->db
            ->where('id', $id)
            ->get('admin');

        return $query->row();
	}
	
    public function getAdminByEmail($email) {

        $query = $this->db
            ->where('email', $email)
            ->get('admin');

        return $query->row();
	}

}

/* End of file Admin_model.php */
