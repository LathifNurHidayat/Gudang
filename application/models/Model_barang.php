<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_barang extends CI_Model
{
    public function count_barang()
    {
        return $this->db->count_all('tb_barang');
    }

    public function get_all_barang($keyword)
    {
        if (!empty($keyword)){
            $this->db->like('j.nama_jenis_barang', $keyword);
            $this->db->or_like('b.nama_barang', $keyword);
            $this->db->or_like('b.harga', $keyword);
            $this->db->or_like('b.stok', $keyword);
        }
        $this->db->select('b.*, j.nama_jenis_barang');
        $this->db->from('tb_barang b');
        $this->db->join('tb_jenis_barang j','b.id_jenis_barang = j.id_jenis_barang', 'LEFT');

        return $this->db->get()->result();
    }

    public function get_barang_by_id($id_barang)
    {
        return $this->db->get_where('tb_barang', ['id_barang' => $id_barang])->row();
    }

    public function insert_barang($data)
    {
        $this->db->insert('tb_barang', $data);

        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }

    public function update_barang($id_barang, $data)
    {
        $this->db->where('id_barang', $id_barang);
        $this->db->update('tb_barang', $data);

        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }

    public function delete_barang($id_barang)
    {
        $this->db->where('id_barang', $id_barang);
        $this->db->delete('tb_barang');

        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }
}