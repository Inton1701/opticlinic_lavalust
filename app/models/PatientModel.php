<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

//::: MODEL/PATIENTMODEL.PHP ::://

class PatientModel extends Model
{
    public function __construct() {
        parent::__construct();
    }

    public function get_patient_by_id($id) {
        $query = $this->db->table('patients')->where('id', $id)->get();

        return $query ? $query : null;
    }

    public function get_all_patients() {
        return $this->db->table('patients')->get()->getResultArray();
    }

    public function add_patient($data) {
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
