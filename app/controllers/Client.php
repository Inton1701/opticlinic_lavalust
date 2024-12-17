<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Client extends Controller {
    
    public function __construct()
    {
        parent::__construct();
    }

    function appointment(){
        $this->call->view('client/appointment');
    }

    function displayNewClientForm(){
        $this->call->view('client/newClient');
    }

}
?>