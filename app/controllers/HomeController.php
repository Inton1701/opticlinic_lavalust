<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

//::: CONTROLLER/HOMECONTROLLER.PHP ::://

class HomeController extends Controller 
{
    public function __construct() {
        parent::__construct();
        $this->call->model('AppointmentModel');
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
        // $appointments_count = $this->model->getAppointmentsCount();
        // $prescriptions_count = $this->model->getPrescriptionsCount();
        // $frames_count = $this->model->getFramesCount();
        // $patients_count = $this->model->getPatientsCount();
        // $upcoming_appointments = $this->model->getUpcomingAppointments();
        // $recent_prescriptions = $this->model->getRecentPrescriptions();
        // $low_stock_frames = $this->model->getLowStockFrames();

        // // Fetching patient check-ins data
        // $patients = $this->model->getPatientCheckins();

        // $this->call->view('home', [
        //     'appointments_count' => $appointments_count,
        //     'prescriptions_count' => $prescriptions_count,
        //     'frames_count' => $frames_count,
        //     'patients_count' => $patients_count,
        //     'upcoming_appointments' => $upcoming_appointments,
        //     'recent_prescriptions' => $recent_prescriptions,
        //     'low_stock_frames' => $low_stock_frames,
        //     'patients' => $patients // Passing the patient data
        // ]);


          $this->call->view('home');

   
    }

    //=== GET ALL DATA ===//
    public function get_all() {
        $appointments_count = $this->model->getAppointmentsCount();
        $prescriptions_count = $this->model->getPrescriptionsCount();
        $frames_count = $this->model->getFramesCount();
        $patients_count = $this->model->getPatientsCount();
        $upcoming_appointments = $this->model->getUpcomingAppointments();
        $recent_prescriptions = $this->model->getRecentPrescriptions();
        $low_stock_frames = $this->model->getLowStockFrames();

        echo json_encode([
            'appointments_count' => $appointments_count,
            'prescriptions_count' => $prescriptions_count,
            'frames_count' => $frames_count,
            'patients_count' => $patients_count,
            'upcoming_appointments' => $upcoming_appointments,
            'recent_prescriptions' => $recent_prescriptions,
            'low_stock_frames' => $low_stock_frames
        ]);
    }

    //=== FRAMES ===//
    public function frames() {
        $this->call->view('frames', 'Frames');
    }

    //=== PROFILE ===//
    public function profile() {
        $this->call->view('profile', 'Profile');
    }

    //=== LOGOUT ===//
    public function logout() {
        session_destroy();
        redirect('auth/login');
    }
}