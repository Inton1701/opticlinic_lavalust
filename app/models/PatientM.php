<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

//::: MODELS/patient_MODEL.PHP ::://

class PatientM extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_patient()
    {
        return $this->db->table('patients')->get_all();
    }

    public function get_patient_by_id($id) {
        return $this->db->table('patients')->where('id', $id)->get();
    }

    public function create_patient($data) {
        return $this->db->table('patients')->insert($data);
    }

    public function update_patient($id, $data) {
        return $this->db->table('patients')->where('id', $id)->update($data);
    }

    public function delete_patient($id) {
        return $this->db->table('patients')->where('id', $id)->delete();
    }
}
?>