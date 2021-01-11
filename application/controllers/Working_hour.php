<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Working_hour extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    protected function middleware() {
        return ['auth'];
    }

    public function add_new() {

        $this->load->helper(array('form', 'url'));

        if ($this->input->method(false) == 'post') {

            $this->load->library('form_validation');

            $this->form_validation->set_rules('environment_id', '', 'trim|required', [
                'required' => 'Environment ID required',
            ]);
            $this->form_validation->set_rules('start', '', 'trim|required', [
                'required' => 'Start date required',
            ]);
            $this->form_validation->set_rules('end', '', 'trim|required', [
                'required' => 'End date required',
            ]);

            if ($this->form_validation->run() === TRUE) {

                $environment_id = $this->input->post('environment_id');
                $start = $this->input->post('start');
                $end = $this->input->post('end');

                $this->db
                    ->set('start', $start)
                    ->set('end', $end)
                    ->set('environment_id', $environment_id)
                    ->insert('environment_working_hour');

                $success = 'Successfully created';

                $this->session->set_flashdata('succ_msg', $success);
                redirect('environment/view?id=' . $environment_id);

            } else {
                $error = 'Unexpected Error';
                redirect('dashboard');
            }

        }

        $error = 'Invalid Request';
        $this->session->set_flashdata('error_msg', $error);
        redirect('dashboard');

    }

    public function delete() {

        $id = $this->input->get('id');
        $admin_id = $this->session->userdata('id');

        $query = $this->db
			->join('environment_admin', 'environment_admin.environment_id = environment_working_hour.environment_id')
            ->where('environment_working_hour.id', $id)
            ->where('environment_admin.admin_id', $admin_id)
			->get('environment_working_hour');

        if ($query->num_rows() > 0) {

            $row = $query->row();

            $this->db
                ->where('id', $id)
                ->delete('environment_working_hour');

            $success = 'Successfully deleted';
            $this->session->set_flashdata('succ_msg', $success);
            redirect('environment/view?id=' . $row->environment_id);

        }

        $error = 'Invalid Request';
        $this->session->set_flashdata('error_msg', $error);
        redirect('dashboard');

    }

}

/* End of file Working_hour.php */
