<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_online_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_users_online_count()
    {
        $now = now() - 60; // Menentukan batas waktu 1 menit untuk menghitung user online

        $this->db->where('last_activity_time >', $now);
        $query = $this->db->get('users_online');

        return $query->num_rows();
    }

    public function update_last_activity_time($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->update('users_online', array('last_activity_time' => now()));
    }

    public function add_user_online($user_id)
    {
        $data = array(
            'user_id' => $user_id,
            'last_activity_time' => now(),
            'is_online' => TRUE
        );

        $this->db->insert('users_online', $data);
    }

    public function remove_user_online($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->delete('users_online');
    }
}
