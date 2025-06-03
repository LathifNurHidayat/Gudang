<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_menu extends CI_Model
{
    public function get_all_menu($keyword)
    {
        if(!empty($keyword)){
            $this->db->like('menu', $keyword);
        }
        return $this->db->get('tb_user_menu')->result_array();
    }

    public function get_menu_by_id($id_menu)
    {
        return $this->db->get_where('tb_user_menu', ['id_menu' => $id_menu])->row();
    }

    public function insert_menu($data)
    {
        $this->db->insert('tb_user_menu', $data);
        if ($this->db->affected_rows() > 0) return true;
        else return false;
    }

    public function update_menu($id_menu, $data)
    {
        $this->db->where('id_menu', $id_menu);
        $this->db->update('tb_user_menu', $data);
        if ($this->db->affected_rows() > 0) return true;
        else return false;
    }
}