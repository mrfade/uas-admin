<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model']);
    }

    public function login() {

        if ($this->session->flashdata('error_msg')) {
            $error = $this->session->flashdata('error_msg');
        }
        if ($this->session->flashdata('succ_msg')) {
            $success = $this->session->flashdata('succ_msg');
        }

        if ($this->input->method(false) == 'post') {

            $email = $this->input->post('email');
            $password = $this->input->post('password');

            if (isset($email) && isset($password)) {

                $admin = $this->admin_model->getAdminByEmail($email);
                if ($admin) {

                    $password_on_db = $admin->password;
                    if (password_verify($password, $password_on_db)) {

						$this->session->set_userdata([
							'login' => true,
							'id' => $admin->id,
							'first_name' => $admin->first_name,
							'last_name' => $admin->last_name,
						]);

						$next = $this->input->get('next');
						if ($next) {
							redirect($next);
						}

						redirect('/');

                    } else {
                        $error = 'Kullanıcı bilgilerinizi yanlış girdiniz';
                    }

                } else {
                    $error = 'Bu bilgilere ait admin bulunamadı';
                }

            } else {
                $error = 'Bu bilgilere ait admin bulunamadı';
            }

        }

        $this->load_view('auth/login', [
            'error' => $error ?? null,
            'success' => $success ?? null,
        ]);

    }

    public function register() {

        $this->load->helper(array('form', 'url'));

        if ($this->input->method(false) == 'post') {

            $this->load->library('form_validation');

            $this->form_validation->set_rules('first_name', '', 'trim|required', [
                'required' => 'Ad zorunludur',
            ]);
            $this->form_validation->set_rules('last_name', '', 'trim|required', [
                'required' => 'Soyad zorunludur',
            ]);
            $this->form_validation->set_rules('password', '', 'trim|required|min_length[6]', [
                'required' => 'Şifre zorunludur',
                'min_length' => 'Şifre en az 6 karakter olmalıdır',
            ]);
            $this->form_validation->set_rules('password_again', '', 'trim|required|matches[password]', [
                'required' => 'Şifre tekrar zorunludur',
                'matches' => 'Şifreler uyuşmuyor',
            ]);
            $this->form_validation->set_rules('email', '', 'trim|required', [
                'required' => 'Email zorunludur',
            ]);
            $this->form_validation->set_rules('tc_number', '', 'trim|required', [
                'required' => 'TC Number zorunludur',
            ]);

            if ($this->form_validation->run() === TRUE) {

                $first_name = $this->input->post('first_name');
                $last_name = $this->input->post('last_name');
                $password = $this->input->post('password');
                $email = $this->input->post('email');
                $tc_number = $this->input->post('tc_number');

                $admin = $this->admin_model->getAdminByEmail($email);
                if (!$admin) {

                    $password = password_hash($password, PASSWORD_DEFAULT);

                    // register
                    $this->db
                        ->set('first_name', $first_name)
                        ->set('last_name', $last_name)
                        ->set('email', $email)
                        ->set('tc_number', $tc_number)
                        ->set('password', $password)
                        ->insert('admin');

                    $success = 'Başarıyla kayıt oldunuz mail adresinize onay maili gönderildi. Spama düşebilir kontrol edin.';

                } else {
                    $error = 'Bu mail zaten kayıtlı';
                }

            }

        }

        $this->load_view('auth/register', [
            'success' => $success ?? null,
            'error' => $error ?? null,
        ]);

    }

    public function logout() {
        $this->session->sess_destroy();

        redirect('auth/login');
    }

}

/* End of file Auth.php */
