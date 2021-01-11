<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fixture extends MY_Controller {

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
            $this->form_validation->set_rules('name', '', 'trim|required', [
                'required' => 'Name required',
            ]);
            $this->form_validation->set_rules('type', '', 'trim|required', [
                'required' => 'Type required',
            ]);
            $this->form_validation->set_rules('description', '', 'trim|required', [
                'required' => 'Description required',
            ]);
            $this->form_validation->set_rules('size', '', 'trim|required', [
                'required' => 'Size required',
            ]);

            if ($this->form_validation->run() === TRUE) {

                $environment_id = $this->input->post('environment_id');
                $name = $this->input->post('name');
                $type = $this->input->post('type');
                $description = $this->input->post('description');
                $size = $this->input->post('size');

                $this->db
                    ->set('name', $name)
                    ->set('type', $type)
                    ->set('description', $description)
                    ->set('size', $size)
                    ->set('environment_id', $environment_id)
                    ->insert('fixture');

                $success = 'Successfully created';

                $this->session->set_flashdata('succ_msg', $success);
                redirect('environment/view?id=' . $environment_id);

            } else {
                $error = 'Unexpected Error';
                $this->session->set_flashdata('error_msg', $error);
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
			->join('environment_admin', 'environment_admin.environment_id = fixture.environment_id')
            ->where('fixture.id', $id)
            ->where('environment_admin.admin_id', $admin_id)
            ->get('fixture');

        if ($query->num_rows() > 0) {

            $row = $query->row();

            $this->db
                ->where('id', $id)
                ->delete('fixture');

            $success = 'Successfully deleted';
            $this->session->set_flashdata('succ_msg', $success);
            redirect('environment/view?id=' . $row->environment_id);

        }

        $error = 'Invalid Request';
        $this->session->set_flashdata('error_msg', $error);
        redirect('dashboard');

    }

}

/* End of file Fixture.php */
