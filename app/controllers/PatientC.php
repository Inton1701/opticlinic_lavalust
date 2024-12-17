<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class PatientC extends Controller 
{
    //=== MODEL ===//
    public function __construct() {
        parent::__construct();
        $this->call->model('PatientM');
    }

    //=== GET patients ===//
    public function patient()
    {
        $data['patients'] = $this->PatientM->get_patient();
        $this->call->view('Optical/patients', $data);
    }

    //=== CREATE patient ===//
    public function create_patient()
    {
        $first_name = $this->io->post('first_name');
        $last_name = $this->io->post('last_name');
        $dob = $this->io->post('dob');
        $gender = $this->io->post('gender');
        $contact_number = $this->io->post('contact_number');
        $email = $this->io->post('email');
        $address = $this->io->post('address');

        $user_id = $_SESSION['user_id'];

        $patient_data = [
        'first_name' => $first_name,    
        'last_name' => $last_name,
        'dob' => $dob,
        'gender' => $gender,
        'contact_number' => $contact_number,
        'email' => $email,
        'address' => $address
        ];

        if ($this->PatientM->create_patient($patient_data)) {
            set_flash_alert('success', 'patient created successfully');
            redirect('/optical-clinic/patient');
        } else {
            set_flash_alert('danger', 'Failed to create patient');
            redirect('/optical-clinic/patient');
        }
    }

    //=== EDIT patient ===//
    public function edit_patient($id)
    {
        $patient = $this->patientM->get_patient($id);
        if (!$patient) {
            set_flash_alert('danger', 'patient not found');
            redirect('/optical-clinic/patients');
        }
        $this->call->view('Optical/edit_patient', ['patient' => $patient]);
    }

    //=== UPDATE PATIENT ===//
    public function update_patient()
    {
        $id = $this->io->post('id');  // Use $this->io instead of $this->request
        $data = [
            'first_name' => $this->io->post('first_name'),
            'last_name' => $this->io->post('last_name'),
            'dob' => $this->io->post('dob'),
            'gender' => $this->io->post('gender'),
            'email' => $this->io->post('email'),
            'contact_number' => $this->io->post('contact_number'),
            'address' => $this->io->post('address')
        ];

        // Update patient information in the database
        if ($this->PatientM->update_patient($id, $data)) {
            set_flash_alert('success', 'Patient information updated successfully');
            redirect('/optical-clinic/patient');  // Redirect to the patients list page
        } else {
            set_flash_alert('danger', 'Failed to update patient information');
            redirect('/optical-clinic/patient');  // Redirect to the patients list page
        }
    }


    public function delete_patient()
    {   
        $id = $this->io->post('id'); // Ensure you get the ID from the POST data
        if ($this->PatientM->delete_patient($id)) {
            set_flash_alert('success', 'patient deleted successfully');
            redirect('/optical-clinic/patient');
        } else {
            set_flash_alert('danger', 'Failed to delete patient');
            redirect('/optical-clinic/patient');
        }
    }
}

?>