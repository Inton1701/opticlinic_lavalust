<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

//::: CONTROLLER/HOMEAUTH.PHP ::://

class HomeAuth extends Controller {

    //=== LAUTH LIB ===//
    public function __construct() {
        parent::__construct();
        $this->call->model('Lauth', 'lauth');

        if (!$this->lauth->is_logged_in()) {
            redirect('auth/login');
        }
    }

    //=== HOMEPAGE ===//
    public function index() {
        $this->call->view('homepage');
    }
}
?>
