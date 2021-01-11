<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Environment_model extends CI_Model {

    public function getEnvironmentsByAdminId($id) {

        $query = $this->db
            ->join('environment', 'environment.id = environment_admin.environment_id')
            ->where('admin_id', $id)
            ->get('environment_admin');

        return $query->result();
    }

    public function getEnvironment($id) {

        $query = $this->db
            ->where('id', $id)
            ->get('environment');

        return $query->row();
    }

    public function getWorkingHours($id) {

        $query = $this->db
            ->where('environment_id', $id)
            ->get('environment_working_hour');

        return $query->result();
	}
	
    public function getFixtures($id) {

        $query = $this->db
            ->where('environment_id', $id)
            ->get('fixture');

        return $query->result();
    }

    public function getAppointments($id) {

        $query = $this->db
            ->join('user', 'user.id = appointment.user_id')
            ->where('environment_id', $id)
            ->get('appointment');

        return $query->result();
	}
	
    public function getAppointmentsNotApproved($id) {

		$query = $this->db
			->select('*, appointment.id as a_id')
			->join('user', 'user.id = appointment.user_id')
			->where('is_accepted', 0)
            ->where('environment_id', $id)
            ->get('appointment');

        return $query->result();
    }

}

/* End of file Environment_model.php */
