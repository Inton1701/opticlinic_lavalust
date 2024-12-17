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
        return $this->db->table('prescriptions')->get_all();
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
}
?>
