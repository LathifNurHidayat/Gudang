<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_jenis_barang extends CI_Model
{
    public function count_jenis_barang()
    {
        return $this->db->count_all('tb_jenis_barang');
    }

    public function get_all_jenis_barang($keyword)
    {
        if(!empty($keyword)){
            $this->db->like('nama_jenis_barang', $keyword);
        }
        return $this->db->get('tb_jenis_barang')->result();
    }

    public function get_jenis_barang_by_id($id_jenis_barang)
    {
        return $this->db->get_where('tb_jenis_barang', ['id_jenis_barang' => $id_jenis_barang])->row();
    }

    public function insert_jenis_barang($data)
    {
        $this->db->insert('tb_jenis_barang', $data);

        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }

    public function update_jenis_barang($id_jenis_barang, $data)
    {
        $this->db->where('id_jenis_barang', $id_jenis_barang);
        $this->db->update('tb_jenis_barang', $data);

        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }

    public function delete_jenis_barang($id_barang)
    {
        $this->db->where('id_jenis_barang', $id_barang);
        $this->db->delete('tb_jenis_barang');

        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }
}