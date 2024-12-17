<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

//::: /CONTROLLER/PRESCRIPTIONCONTROLLER.PHP ::://

class PrescriptionController extends Controller
{
    //=== MODEL ===//
    public function __construct()
    {
        parent::__construct();
        $this->call->model('PrescriptionModel');
        $this->call->model('PatientModel');
        $this->call->model('InventoryModel');
    }

    //=== GET PRESCRIPTIONS ===//
    public function prescriptions()
    {
        $data['prescriptions'] = $this->PrescriptionModel->get_prescriptions();
    
        // Fetching first_name for each prescription
        foreach ($data['prescriptions'] as &$prescription) {
            $patient = $this->PatientModel->get_patient_by_id($prescription['patient_id']);
            $prescription['patient_first_name'] = $patient ? $patient['first_name'] : 'N/A'; // Fallback to 'N/A' if patient not found
    }

    $this->call->view('Optical/prescriptions', $data);
    }

    // CREATE PRESCRIPTIONS
    public function create_prescription()
    {
        $patient_id = $_POST['patient_id'] ?? null;
        $patient = $this->PatientModel->get_patient_by_id($patient_id);

        if ($patient) {
            // Retrieve the patient's first name
            $first_name = $patient['first_name'];

            // Prepare the data for the new prescription
            $data = [
                'patient_id' => $patient_id, // Keep patient_id for reference
                'patient_name' => $first_name, // Store patient's first_name in the prescription
                'medication' => $_POST['medication'] ?? '',
                'dosage' => $_POST['dosage'] ?? '',
                'duration' => $_POST['duration'] ?? '',
                'renewal_date' => $_POST['renewal_date'] ?? ''
            ];

            // Create the prescription and check if it was successful
            if ($this->PrescriptionModel->create_prescription($data)) {
                $_SESSION['message'] = 'Prescription Created Successfully';
                header("Location: " . site_url('optical-clinic/prescriptions'));
                exit();
            }
        } else {
            $_SESSION['message'] = 'Patient not found!';
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

    //=== UPDATE PRESCRIPTION ===//
    public function update_prescription($id)
    {
        $data = [
            'medication' => $_POST['medication'] ?? '',
            'dosage' => $_POST['dosage'] ?? '',
            'duration' => $_POST['duration'] ?? '',
            'renewal_date' => $_POST['renewal_date'] ?? ''
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
}
?>
