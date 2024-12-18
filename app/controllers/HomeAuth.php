<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

//::: CONTROLLER/HOMEAUTH.PHP ::://

class HomeAuth extends Controller {

    //=== LAUTH LIB ===//
    public function __construct() {
        parent::__construct();
        $this->call->model('Lauth', 'lauth');
        $this->call->model('AppointmentModel');
        $this->call->model('HomeModel');
        $userRole = $this->session->userdata('role');
        if (!$this->lauth->is_logged_in()) {
            redirect('auth/login');
        }
        if ($userRole != 'admin') {
            redirect('auth/login');
        }
    }



    //=== HOMEPAGE ===//
    public function index() {
        $data = [];
        $appointments = $this->AppointmentModel->get_users();
        $data = $this->HomeModel->get_home_data();
        $this->call->view('homepage',[
            'appointments' => $appointments,
            'dashboardData' => $data

        ]);
    
    }
    // public function fetch_dashboard_data() {
    //     // Define API request for identifying API-specific logic in the controller
    //     define('API_REQUEST', true);
    
    //     // Set content type to JSON for the response
    //     header('Content-Type: application/json');
    
    //     try {
    //         // Fetch raw data from the model
    //         $data = $this->HomeModel->get_home_data();
    
    //         // Check if data is returned and properly structured
    //         if (empty($data)) {
    //             throw new Exception("No data available to fetch.");
    //         }
    
    //         // Respond with success
    //         echo json_encode([
    //             'success' => true,
    //             'data' => $data,
    //         ]);
    //     } catch (Exception $e) {
    //         // Respond with an error message in case of failure
    //         http_response_code(500); // Internal Server Error
    //         echo json_encode([
    //             'success' => false,
    //             'message' => $e->getMessage(),
    //         ]);
    //     } finally {
    //         // Ensure no further content is rendered
    //         exit;
    //     }
    // }
    
    
}
?>