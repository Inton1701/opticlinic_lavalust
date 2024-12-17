<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

//::: MODELS/APPOINTMENT_MODEL.PHP ::://

class AppointmentModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_users()
    {
        return $this->db->table('appointments')->get_all();
    }

    public function get_appointment_by_id($id) {
        return $this->db->table('appointments')->where('id', $id)->get();
    }

    public function create_appointment($data) {
        return $this->db->table('appointments')->insert($data);
    }

    public function update_appointment($id, $data) {
        return $this->db->table('appointments')->where('id', $id)->update($data);
    }

    public function delete_appointment($id) {
        return $this->db->table('appointments')->where('id', $id)->delete();
    }
}
?>