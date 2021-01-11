<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['environment_model']);
    }

    protected function middleware() {
        return ['auth'];
    }

    public function index() {

        if ($this->session->flashdata('error_msg')) {
            $error = $this->session->flashdata('error_msg');
        }
        if ($this->session->flashdata('succ_msg')) {
            $success = $this->session->flashdata('succ_msg');
        }

        $admin_id = $this->session->userdata('id');

        $environments = $this->environment_model->getEnvironmentsByAdminId($admin_id);

        $this->load_view('dashboard', [
            'environments' => $environments,
            'error' => $error ?? null,
            'success' => $success ?? null,
        ]);
    }
}
