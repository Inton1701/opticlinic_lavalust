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

    function updatePersonalData(){
        $id = $this->session->userdata('id');
        $fName = $this->io->post('fName');
        $lName = $this->io->post('lName');
        $dob = $this->io->post('dob');
        $gender = $this->io->post('gender');
        $contactNum = $this->io->post('number');
        $address = $this->io->post('address');
        $this->updatePersonalData($id, $fName, $lName, $dob, $gender, $contactNum, $address);
    }

}
?>