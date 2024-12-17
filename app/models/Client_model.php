<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Client_model extends Model {
    
    public function __construct()
    {
        parent::__construct();
    }

   function updatePersonalData($id, $fName, $lName, $dob, $gender, $contactNum, $address) {
        $sql = "
            UPDATE users 
            SET 
                first_name = ?, 
                last_name = ?, 
                dob = ?, 
                gender = ?, 
                contact_number = ?, 
                address = ? 
            WHERE id = ?
        ";
        return $this->db->raw($sql, [$fName, $lName, $dob, $gender, $contactNum, $address, $id]);
    }


}
?>