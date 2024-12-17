<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

//::: /CONTROLLER/PRESCRIPTIONCONTROLLER.PHP ::://

class PrescriptionController extends Controller
{
    //=== MODEL ===//
    public function __construct()
    {
        parent::__construct();
        $userRole = $this->session->userdata('role');
        if (!$this->lauth->is_logged_in()) {
            redirect('auth/login');
        }
        if ($userRole != 'admin') {
            redirect('auth/login');
        }
        $this->call->model('PrescriptionModel');
        $this->call->model('PatientModel');
        $this->call->model('InventoryModel');
    }

    //=== GET PRESCRIPTIONS ===//
    public function prescriptions()
    {
        $data['prescriptions'] = $this->PrescriptionModel->get_prescriptions();
    

    $this->call->view('Optical/prescriptions', $data);
    }

    // CREATE PRESCRIPTIONS
    public function create_prescription()
    {
        $patient_id = $this->io->post('user_id');

            // Prepare the data for the new prescription
            $data = [
                'user_id' => $patient_id, 
                'medication' => $_POST['medication'] ?? '',
                'dosage' => $_POST['dosage'] ?? '',
                'duration' => $_POST['duration'] ?? '',
                'checkup_date' => $_POST['renewal_date'] ?? ''
            ];

            // Create the prescription and check if it was successful
            if ($this->PrescriptionModel->create_prescription($data)) {
                $_SESSION['message'] = 'Prescription Created Successfully';
                header("Location: " . site_url('optical-clinic/prescriptions'));
                exit();
            }

    }

    //=== EDIT PRESCRIPTION ===//
    public function edit_prescription($id)
    {
        $prescription = $this->PrescriptionModel->get_prescription($id);
        if (!$prescription) {
            $_SESSION['message'] = 'Prescription not found.';
            header("Location: " . site_url('optical-clinic/prescriptions'));
            exit();
        }
        return $this->call->view('Optical/edit_prescription', ['prescription' => $prescription]);
    }


    public function update_prescription()
    {
        $id = $this->io->post('prescription_id');
        $data = [
            'medication' => $_POST['medication'] ?? '',
            'dosage' => $_POST['dosage'] ?? '',
            'duration' => $_POST['duration'] ?? '',
            'checkup_date' => $_POST['checkup_date'] ?? ''
        ];

        if ($this->PrescriptionModel->update_prescription($id, $data)) {
            $_SESSION['message'] = 'Prescription updated successfully';
            header("Location: " . site_url('optical-clinic/prescriptions'));
            exit();
        } else {
            $_SESSION['message'] = 'Failed to update prescription';
            header("Location: " . site_url('optical-clinic/prescriptions'));
            exit();
        }
    }

    //=== DELETE PRESCRIPTION ===//
    public function delete_prescription($id)
    {
        if ($this->PrescriptionModel->delete_prescription($id)) {
            $_SESSION['message'] = 'Prescription deleted successfully.';
            header("Location: " . site_url('optical-clinic/prescriptions'));
            exit();
        } else {
            $_SESSION['message'] = 'Failed to delete prescription.';
            header("Location: " . site_url('optical-clinic/prescriptions'));
            exit();
        }
    }

    public function search_user($query)
    {
        if (empty($query)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Search query is missing'
            ]);
            return;
        }
    
        // Call the model to search users
        $users = $this->PatientModel->search_patient($query);
    
        // Ensure the response `data` is always an array
        if (!empty($users)) {
            // Check if single user or multiple users and force array format
            $result = is_array($users) ? $users : [$users];
    
            echo json_encode([
                'status' => 'success',
                'data' => $result
            ]);
        } else {
            echo json_encode([
                'status' => 'success',
                'message' => 'No users found'
            ]);
        }
    }
}
?>