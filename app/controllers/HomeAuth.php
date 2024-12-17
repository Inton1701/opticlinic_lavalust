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

        // if (!$this->lauth->is_logged_in()) {
        //     redirect('auth/login');
        // }
    }



    //=== HOMEPAGE ===//
    public function index() {
        $appointments = $this->AppointmentModel->get_users();
        $this->call->view('homepage',[
            'appointments' => $appointments
        ]);
    }
    public function fetch_dashboard_data() {
        header('Content-Type: application/json');
    
        try {
            // Fetch raw data from the model
            $data = $this->HomeModel->get_home_data();
 
            echo json_encode([
                'success' => true,
                'data' => $data,
            ]);
        } catch (Exception $e) {
      
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    
        
    }
    
}
?>