<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_role extends CI_Model
{
    public function get_all_role()
    {
        return $this->db->get('tb_user_role')->result();
    }

    public function get_role_by_id($id_role)
    {
        return $this->db->get_where('tb_user_role', ['id_role' => $id_role])->row();
    }

    public function insert_role($data)
    {
        $this->db->insert('tb_user_role', $data);

        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }

    public function update_role($id_role, $data)
    {
        $this->db->where('id_role', $id_role);
        $this->db->update('tb_user_role', $data);

        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }
}