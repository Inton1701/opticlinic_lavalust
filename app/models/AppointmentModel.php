<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

//::: MODELS/APPOINTMENT_MODEL.PHP ::://

class AppointmentModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_users()
    {
        return $this->db->table('appointments as a')
        ->select('a.id as appointment_id, u.first_name, u.last_name, a.date, a.time, a.description, a.status')
        ->inner_join('users as u', 'a.user_id = u.id')
        ->where('u.role', 'patient')
        ->get_all();
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