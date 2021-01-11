<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AuthMiddleware {
    // Get injected controller and ci references
    protected $controller;
    protected $ci;
    protected $admin_info;

    // Some custom and example data related to this class
    public $roles = array();

    // All middlewares will pass controller and ci class objects as references to constructor
    // It's upto you, that what you do with them
    // Obviously it's not required :)

    public function __construct($controller, $ci) {
        $this->controller = $controller;
        $this->ci = $ci;
    }

    // This function is required, and is entry point to this class
    public function run() {

        if (!$this->ci->session->has_userdata('login')) {
            $uri_string = uri_string();
            $params = $this->ci->input->server('QUERY_STRING');

            if ($params) {
                $uri_string .= '?' . $params;
            }

            $uri_string = urlencode($uri_string);

            if ($uri_string) {
                redirect('auth/login?next=' . $uri_string);
            }

            redirect('auth/login');
        }

    }
}

/* End of file AuthMiddleware.php */
