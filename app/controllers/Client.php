<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Client extends Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->call->model('client_model', 'client');
        $userRole = $this->session->userdata('role');
        if (!$this->lauth->is_logged_in()) {
            redirect('auth/login');
        }
        if ($userRole != 'patient') {
            redirect('auth/login');
        }
    }

    function appointment(){
        $this->call->view('client/appointment');
    }

    function getCredentials(){
        $id = $this->session->userdata('id');
        $data['credentials'] = $this->client->getCredentials($id);
        $this->call->view('client/credentials', $data);
    }

    function displayNewClientForm(){
        $this->call->view('client/newUserCredentials');
    }

    function updatePersonalData(){
        $id = $this->session->userdata('id');
        $fName = $this->io->post('fName');
        $lName = $this->io->post('lName');
        $dob = $this->io->post('dob');
        $gender = $this->io->post('gender');
        $contactNum = $this->io->post('number');
        $address = $this->io->post('address');
        if ($this->client->updatePersonalData($id, $fName, $lName, $dob, $gender, $contactNum, $address)) {
            set_flash_alert('success', 'Your credentials have been updated successfully.');
            redirect('/client/appointment');
        } else {
            redirect('/client/appointment');
        }
    }

    function appoint(){
        $id = $this->session->userdata('id');
        $prefDate = $this->io->post('date');
        $prefTime = $this->io->post('time');
        $des = $this->io->post('description');
        if ($this->client->appoint($id, $prefDate, $prefTime, $des)) {
           set_flash_alert('success', 'Your appointment has been successfully made.');
            redirect('/client/appointment');
        }
    }

    function getAppointmentRecords(){
        $id = $this->session->userdata('id');
        $appointments['appointments']=$this->client->getAppointmentRecords($id);
        $this->call->view('client/appointmentRecords', $appointments);
    }

    function cancelAppointment(){
        $id = $this->io->post('id');
        $this->client->cancelAppointment($id);
        redirect('/client/records');
    }

    function getPrescriptions(){
        $id = $this->session->userdata('id');
        $prescriptions['prescriptions']=$this->client->getPrescriptions($id);
        $this->call->view('client/prescriptions', $prescriptions);
    }

}
?>