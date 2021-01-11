<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Environment extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['environment_model']);
    }

    protected function middleware() {
        return ['auth'];
    }

    public function view() {

        if ($this->session->flashdata('error_msg')) {
            $error = $this->session->flashdata('error_msg');
        }
        if ($this->session->flashdata('succ_msg')) {
            $success = $this->session->flashdata('succ_msg');
        }

        $id = $this->input->get('id');
        $environment = $this->environment_model->getEnvironment($id);

        if (!$environment) {
            redirect('/');
        }

        $working_hours = $this->environment_model->getWorkingHours($id);
        $fixtures = $this->environment_model->getFixtures($id);
        $appointments = $this->environment_model->getAppointmentsNotApproved($id);

        $this->load_view('environment/view', [
            'id' => $id,
            'working_hours' => $working_hours,
            'fixtures' => $fixtures,
            'appointments' => $appointments,
            'error' => $error ?? null,
            'success' => $success ?? null,
        ]);
    }

    public function add_new() {

        $admin_id = $this->session->userdata('id');

        $this->load->helper(array('form', 'url'));

        if ($this->input->method(false) == 'post') {

            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', '', 'trim|required', [
                'required' => 'Name required',
            ]);
            $this->form_validation->set_rules('type', '', 'trim|required', [
                'required' => 'Type required',
            ]);
            $this->form_validation->set_rules('location', '', 'trim|required', [
                'required' => 'Location required',
            ]);
            $this->form_validation->set_rules('capacity', '', 'trim|required', [
                'required' => 'Capacity required',
            ]);

            if ($this->form_validation->run() === TRUE) {

                $name = $this->input->post('name');
                $type = $this->input->post('type');
                $location = $this->input->post('location');
                $capacity = $this->input->post('capacity');

                $this->db->trans_start();

                $this->db
                    ->set('name', $name)
                    ->set('type', $type)
                    ->set('location', $location)
                    ->set('capacity', $capacity)
                    ->insert('environment');

                $insert_id = $this->db->insert_id();

                $this->db
                    ->set('admin_id', $admin_id)
                    ->set('environment_id', $insert_id)
                    ->insert('environment_admin');

                $this->db->trans_complete();

                if ($this->db->trans_status() !== FALSE) {

                    $success = 'Successfully created';
                    $this->session->set_flashdata('succ_msg', $success);
                    redirect('environment/view?id=' . $insert_id);

                } else {

                    $error = 'Unexpected Error';
                    $this->session->set_flashdata('error_msg', $error);
                    redirect('dashboard');

                }

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

    public function export_xml() {

        $id = $this->input->get('id');
        $_environment = $this->environment_model->getEnvironment($id);
		$_fixtures = $this->environment_model->getFixtures($id);
		
		// print_r($environment);
		// exit;

        if (!$_environment) {
            redirect('dashboard');
        }

        header("Content-type: text/xml; charset=utf-8");

        $xml = new DOMDocument("1.0");
        $xml->formatOutput = true;

        $environment = $xml->createElement("environment");
        $xml->appendChild($environment);

        $id = $xml->createElement("id", $_environment->id);
        $environment->appendChild($id);

        $name = $xml->createElement("name", $_environment->name);
        $environment->appendChild($name);

        $type = $xml->createElement("type", $_environment->type);
        $environment->appendChild($type);

        $location = $xml->createElement("location", $_environment->location);
        $environment->appendChild($location);

        $capacity = $xml->createElement("capacity", $_environment->capacity);
        $environment->appendChild($capacity);

        $fixtures = $xml->createElement("fixtures");
        $environment->appendChild($fixtures);

        foreach ($_fixtures as $_fixture) {
            $fixture = $xml->createElement("fixture");
            $fixtures->appendChild($fixture);

            $id = $xml->createElement("id", $_fixture->id);
            $fixture->appendChild($id);

            $name = $xml->createElement("name", $_fixture->name);
            $fixture->appendChild($name);

            $type = $xml->createElement("type", $_fixture->type);
            $fixture->appendChild($type);

            $description = $xml->createElement("description", $_fixture->description);
            $fixture->appendChild($description);

            $size = $xml->createElement("size", $_fixture->size);
            $fixture->appendChild($size);
        }

        echo $xml->saveXML();

    }

}

/* End of file Environment.php */
