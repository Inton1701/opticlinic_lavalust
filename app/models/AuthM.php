<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

//::: MODELS/APPOINTMENT_MODEL.PHP ::://

class AuthM extends Model {

    function getUser($id) {
        return $this->db->table('users')->where('id', $id)->get();
    }

    public function get_user_by_email($email) {
        $sql = "SELECT * FROM users WHERE email = ?";
        return $this->db->query($sql, [$email])->row();
    }

    public function create_user($data) {
        $sql = "INSERT INTO users (username, email, first_name, last_name, password, email_token, created_at) VALUES (?, ?, ?, ?, ?)";
        return $this->db->query($sql, [
            $data['username'],
            $data['email'],
            $data['password'],
            $data['email_token'],
            date('Y-m-d H:i:s')
        ]);
    }

    public function validate_user($email, $password) {
        $user = $this->get_user_by_email($email);
        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return null;
    }

    public function store_password_reset_token($email, $token) {
        $sql = "UPDATE users SET password_reset_token = ?, token_expiry = ? WHERE email = ?";
        return $this->db->query($sql, [
            $token,
            date('Y-m-d H:i:s', strtotime('+1 hour')),
            $email
        ]);
    }

    public function get_user_by_reset_token($token) {
        $sql = "SELECT * FROM users WHERE password_reset_token = ? AND token_expiry > ?";
        return $this->db->query($sql, [$token, date('Y-m-d H:i:s')])->row();
    }

    public function update_password($token, $new_password) {
        $sql = "UPDATE users SET password = ?, password_reset_token = NULL, token_expiry = NULL WHERE password_reset_token = ?";
        return $this->db->query($sql, [
            password_hash($new_password, PASSWORD_BCRYPT),
            $token
        ]);
    }

    public function is_unique($field, $value) {
        $sql = "SELECT * FROM users WHERE {$field} = ?";
        return $this->db->query($sql, [$value])->num_rows() === 0;
    }

    public function logout_user($user_id) {
        $sql = "UPDATE users SET last_logged_out = ? WHERE id = ?";
        return $this->db->query($sql, [
            date('Y-m-d H:i:s'),
            $user_id
        ]);
    }
}
?>