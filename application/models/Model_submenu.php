<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_submenu extends CI_Model
{
    public function get_all_submenu($keyword)
    {
        if(!empty($keyword)){
            $this->db->like('bb.menu', $keyword);
            $this->db->or_like('aa.title', $keyword);
            $this->db->or_like('aa.url', $keyword);
            $this->db->or_like('aa.icon', $keyword);
        }

        $this->db->select('aa.*, bb.menu');
        $this->db->from('tb_sub_menu aa');
        $this->db->join('tb_user_menu bb', 'aa.id_menu = bb.id_menu', 'Left');
        return $this->db->get()->result_array();
    }

    public function get_submenu_by_id($id_sub_menu)
    {
        return $this->db->get_where('tb_sub_menu', ['id_sub_menu' => $id_sub_menu])->row_array();
    }

    public function insert_submenu($data)
    {
        $this->db->insert('tb_sub_menu', $data);

        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }

    public function update_submenu($id_sub_menu, $data)
    {
        $this->db->where('id_sub_menu', $id_sub_menu);
        $this->db->update('tb_sub_menu', $data);

        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }
}