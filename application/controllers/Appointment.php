<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment extends MY_Controller {

    public function __construct() {
        parent::__construct();

    }

    protected function middleware() {
        return ['auth'];
    }

    public function approve() {

        $id = $this->input->get('id');
        $admin_id = $this->session->userdata('id');

        $query = $this->db
            ->join('environment', 'environment.id = appointment.environment_id')
            ->join('environment_admin', 'environment_admin.environment_id = environment.id')
            ->where('appointment.id', $id)
            ->where('environment_admin.admin_id', $admin_id)
			->get('appointment');

        if ($query->num_rows() > 0) {

            $row = $query->row();

			$this->db
				->set('is_accepted', '1')
                ->where('id', $id)
                ->update('appointment');

            $success = 'Successfully approved';
            $this->session->set_flashdata('succ_msg', $success);
            redirect('environment/view?id=' . $row->environment_id);

        }

        $error = 'Invalid Request';
        $this->session->set_flashdata('error_msg', $error);
        redirect('dashboard');

    }

}

/* End of file Appointment.php */
