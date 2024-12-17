<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Client_model extends Model {
    
    public function __construct()
    {
        parent::__construct();
    }

    function updatePersonalData($id, $fName, $lName, $dob, $gender, $contactNum, $address) {
        $personalInfo = array(
            'first_name' => $fName,
            'last_name' => $lName,
            'dob' => $dob,
            'gender' => $gender,
            'contact_number' => $contactNum,
            'address' => $address
        );
        return $this->db->table('users')->where('id', $id)->update($personalInfo);
    }

    function appoint($id, $prefDate, $prefTime, $des){
        $appointmentData = array(
            'user_id' => $id,
            'date' => $prefDate,
            'time' => $prefTime,
            'description' => $des,
            'status' => 'Pending'
        );
        return $this->db->table('appointments')->insert($appointmentData);
    }

    function getAppointmentRecords($id){
      return $this->db->table('appointments')->where('user_id', $id)->get_all();
    }

    function cancelAppointment($id){
        return $this->db->table('appointments')->where('id', $id)->delete();
    }

    function getPrescriptions($id){
        return $this->db->table('prescriptions')->where('user_id', $id)->get_all();
    }

    function getCredentials($id){
        return $this->db->table('users')->where('id', $id)->get();
    }
}
?>