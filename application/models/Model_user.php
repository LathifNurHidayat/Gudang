<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_user extends CI_Model
{
    public function count_user()
    {
        return $this->db->count_all('tb_user');
    }

    public function get_user_by_username($username)
    {
        $this->db->where('username', $username);
        return $this->db->get('tb_user')->row();
    }

    public function get_all_user()
    {
        return $this->db->get('tb_user')->result();
    }

    public function get_user_by_id($id_user)
    {
        return $this->db->get_where('tb_user', ['id_user' => $id_user])->row();
    }

    public function insert_user($data)
    {
        $this->db->insert('tb_user', $data);

        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }

    public function update_user($id_user, $data)
    {
        $this->db->where('id_user', $id_user);
        $this->db->update('tb_user', $data);

        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }

    public function delete_user($id_user)
    {
        $this->db->where('id_user', $id_user);
        $this->db->delete('tb_user');

        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }
}