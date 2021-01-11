<?php
/**
 * Author: https://github.com/davinder17s
 * Email: davinder17s@gmail.com
 * Repository: https://github.com/davinder17s/codeigniter-middleware
 */

class MY_Controller extends CI_Controller {

    protected $middlewares = array();

    public function __construct() {
        parent::__construct();
        $this->_run_middlewares();
    }

    protected function middleware() {
        return array();
    }

    protected function _run_middlewares() {
        $this->load->helper('inflector');
        $middlewares = $this->middleware();
        foreach ($middlewares as $middleware) {
            $middlewareArray = explode('|', str_replace(' ', '', $middleware));
            $middlewareName = $middlewareArray[0];
            $runMiddleware = true;
            if (isset($middlewareArray[1])) {
                $options = explode(':', $middlewareArray[1]);
                $type = $options[0];
                $methods = explode(',', $options[1]);
                if ($type == 'except') {
                    if (in_array($this->router->method, $methods)) {
                        $runMiddleware = false;
                    }
                } else if ($type == 'only') {
                    if (!in_array($this->router->method, $methods)) {
                        $runMiddleware = false;
                    }
                }
            }
            $filename = ucfirst(camelize($middlewareName)) . 'Middleware';
            if ($runMiddleware == true) {
                if (file_exists(APPPATH . 'middlewares/' . $filename . '.php')) {
                    require APPPATH . 'middlewares/' . $filename . '.php';
                    $ci = &get_instance();
                    $object = new $filename($this, $ci);
                    $object->run();
                    $this->middlewares[$middlewareName] = $object;
                    $prop = $middlewareName . '_middleware';
                    $this->$prop = $object;
                } else {
                    if (ENVIRONMENT == 'development') {
                        show_error('Unable to load middleware: ' . $filename . '.php');
                    } else {
                        show_error('Sorry something went wrong.');
                    }
                }
            }

        }
    }

    public function load_view($view_name, $_options = []) {

        $options = [
            'page_header' => true,
            'page_footer' => true,
            'header' => true,
            'footer' => true,
            'login' => $this->session->userdata(),
            'router' => [
                'class' => $this->router->class,
                'method' => $this->router->method,
            ],
        ];

        // merge options
        foreach ($_options as $_opt_key => $_opt_val) {
            $options[$_opt_key] = $_opt_val;
        }

        if ($options['page_header']) {
            $this->load->view('static/header', $options);
        }

        if ($options['header']) {
            $this->load->view('components/header', $options);
        }

        $this->load->view($view_name, $options);

        if ($options['footer']) {
            $this->load->view('components/footer', $options);
        }

        if ($options['page_footer']) {
            $this->load->view('static/footer', $options);
        }

    }
}
