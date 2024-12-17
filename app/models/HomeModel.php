<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

//::: MODELS/HOMEMODEL.PHP ::://

    class HomeModel extends Model 
    {
        public function getAppointmentsCount() {
            $query = $this->db->query('SELECT COUNT(*) AS count FROM appointments WHERE WEEK(date) = WEEK(CURRENT_DATE)');
            $result = $query->getRowArray();
            return $result['count'];
        }

        public function getPrescriptionsCount() {
            $query = $this->db->query('SELECT COUNT(*) AS count FROM prescriptions WHERE MONTH(date) = MONTH(CURRENT_DATE)');
            $result = $query->getRowArray();
            return $result['count'];
        }

        public function getFramesCount() {
            $query = $this->db->query('SELECT COUNT(*) AS count FROM frames WHERE stock > 0');
            $result = $query->getRowArray();
            return $result['count'];
        }

        public function getPatientsCount() {
            $query = $this->db->query('SELECT COUNT(*) AS count FROM patients WHERE status = "active"');
            $result = $query->getRowArray();
            return $result['count'];
        }

        public function getUpcomingAppointments() {
            $query = $this->db->query('SELECT COUNT(*) AS count FROM appointments WHERE date > CURRENT_DATE');
            $result = $query->getRowArray();
            return $result['count'];
        }

        public function getRecentPrescriptions() {
            $query = $this->db->query('SELECT COUNT(*) AS count FROM prescriptions WHERE date > DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH)');
            $result = $query->getRowArray();
            return $result['count'];
        }

        public function getLowStockFrames() {
            $query = $this->db->query('SELECT COUNT(*) AS count FROM frames WHERE stock <= 5');
            $result = $query->getRowArray();
            return $result['count'];
        }

        // New method to get patient check-ins data
        public function getPatientCheckins() {
            // Query to join appointments and users table
            $query = $this->db->query('
                SELECT u.username, a.date, a.time, p.status 
                FROM appointments a
                JOIN users u ON a.user_id = u.id
                LEFT JOIN patients p ON p.user_id = u.id
                WHERE a.date = CURRENT_DATE
            ');
            return $query->getResult();
        }
    
    }
