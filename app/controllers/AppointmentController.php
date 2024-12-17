<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

//::: CONTROLLER/APPOINTMENTCONTROLLER.PHP ::://

class AppointmentController extends Controller 
{
    //=== MODEL ===//
    public function __construct() {
        parent::__construct();
        $this->call->model('AppointmentModel');
    }

    //=== GET APPOINTMENTS ===//
    public function appointments()
    {
        $data['appointments'] = $this->AppointmentModel->get_users();
        $this->call->view('Optical/appointments', $data);
    }

    //=== CREATE APPOINTMENT ===//
    public function create_appointment()
    {
        $date = $this->io->post('date');
        $time = $this->io->post('time');
        $description = $this->io->post('description');
        $status = $this->io->post('status');

        $user_id = $_SESSION['user_id'];

        $appointment_data = [
            'user_id' => $user_id,
            'date' => $date,
            'time' => $time,
            'description' => $description,
            'status' => $status
        ];

        if ($this->AppointmentModel->create_appointment($appointment_data)) {
            set_flash_alert('success', 'Appointment created successfully');
            redirect('/optical-clinic/appointments');
        } else {
            set_flash_alert('danger', 'Failed to create appointment');
            redirect('/optical-clinic/appointments');
        }
    }

    //=== EDIT APPOINTMENT ===//
    public function edit_appointment($id)
    {
        $appointment = $this->AppointmentModel->get_appointment($id);
        if (!$appointment) {
            set_flash_alert('danger', 'Appointment not found');
            redirect('/optical-clinic/appointments');
        }
        $this->call->view('Optical/edit_appointment', ['appointment' => $appointment]);
    }

    //=== UPDATE APPOINTMENT ===//
    public function update_appointment()
    {
        $id = $this->io->post('id');  // Use $this->io instead of $this->request
        $data = [
            'date' => $this->io->post('date'),
            'time' => $this->io->post('time'),
            'description' => $this->io->post('description'),
            'status' => $this->io->post('status')
        ];

        if ($this->AppointmentModel->update_appointment($id, $data)) {
            set_flash_alert('success', 'Appointment updated successfully');
            redirect('/optical-clinic/appointments');
        } else {
            set_flash_alert('danger', 'Failed to update appointment');
            redirect('/optical-clinic/appointments');
        }
    }

    //=== DELETE APPOINTMENT ===//
    public function delete_appointment()
    {   
        $id = $this->io->post('id'); // Ensure you get the ID from the POST data
        if ($this->AppointmentModel->delete_appointment($id)) {
            set_flash_alert('success', 'Appointment deleted successfully');
            redirect('/optical-clinic/appointments');
        } else {
            set_flash_alert('danger', 'Failed to delete appointment');
            redirect('/optical-clinic/appointments');
        }
    }
}

?>