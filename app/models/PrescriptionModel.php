<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

//::: MODEL/PRESCRIPTIONMODEL.PHP ::://

class PrescriptionModel extends Model {

    public function get_patient($id)
    {
        return $this->db->table('patients')
                        ->where('id', $id)   
                        ->get()              
                        ->getRowArray();     
    }

    public function __construct() {
        parent::__construct();
    }

    public function get_prescriptions() {
        return $this->db->table('prescriptions as a')
        ->select('a.id as prescription_id , u.first_name, u.last_name, a.checkup_date, a.dosage, a.duration, a.medication')
        ->inner_join('users as u', 'a.user_id = u.id')
        ->where('u.role', 'patient')
        ->get_all();
    }

    public function get_prescription($id) {
        return $this->db->table('prescriptions')->where('id', $id)->get();
    }

    public function create_prescription($data) {
        return $this->db->table('prescriptions')->insert($data);
    }

    public function update_prescription($id, $data) {
        return $this->db->table('prescriptions')->where('id', $id)->update($data);
    }

    public function delete_prescription($id) {
        return $this->db->table('prescriptions')->where('id', $id)->delete();
    }
    public function search_patient($id) {
        return $this->db->table('users')
            ->like('first_name', "%{$id}%")
            ->or_like('last_name', "%{$id}%")
            ->where('role','patient')
            ->limit(10)
            ->get_all();
    }
}
?>
