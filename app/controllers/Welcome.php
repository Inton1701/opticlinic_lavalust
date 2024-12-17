<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

//::: CONTROLLER/WELCOME.PHP ::://

class Welcome extends Controller {
	public function index() {
		$this->call->view('auth/login');
	}
}
?>