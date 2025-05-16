<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login();

        $this->load->model("model_jenis_barang");
    }

    public function index()
    {
        $data['jenis_barang'] = $this->model_jenis_barang->get_all_jenis_barang();

        $this->load->view("templates/header");
        $this->load->view("templates/sidebar");
        $this->load->view("jenis_barang/view_jenis_barang", $data);
        $this->load->view("templates/footer");
    }

    public function add_jenis_barang()
    {

        $this->load->view("templates/header");
        $this->load->view("templates/sidebar");
        $this->load->view("jenis_barang/add_jenis_barang");
        $this->load->view("templates/footer");
    }

    public function edit_jenis_barang($id_jenis_barang)
    {
        $data['jenis_barang'] = $this->model_jenis_barang->get_jenis_barang_by_id($id_jenis_barang);

        $this->load->view("templates/header");
        $this->load->view("templates/sidebar");
        $this->load->view("jenis_barang/edit_jenis_barang", $data);
        $this->load->view("templates/footer");
    }

    public function insert_jenis_barang()
    {
        $this->form_validation->set_rules('nama_jenis_barang', 'Jenis Barang', 'required');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('jenis_barang/add_jenis_barang');
            $this->load->view('templates/footer');
            return;
        }

        $data = [
            'nama_jenis_barang' => $this->input->post('nama_jenis_barang', TRUE),
        ];

        $query_cek = $this->model_jenis_barang->insert_jenis_barang($data);
        if ($query_cek)
            $this->session->set_flashdata('msg', alert_success('Data berhasil disimpan'));
        else
            $this->session->set_flashdata('msg', alert_error('Data gagal disimpan'));

        redirect('jenis_barang/index');
    }


    public function update_jenis_barang()
    {
        $this->form_validation->set_rules('nama_jenis_barang', 'Jenis Barang', 'required');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('jenis_barang/add_jenis_barang');
            $this->load->view('templates/footer');
            return;
        }

        $id_jenis_barang = $this->input->post('id_jenis_barang', TRUE);

        $data = [
            'nama_jenis_barang' => $this->input->post('nama_jenis_barang', TRUE),
        ];

        $query_cek = $this->model_jenis_barang->update_jenis_barang($id_jenis_barang, $data);
        if ($query_cek)
            $this->session->set_flashdata('msg', alert_success('Data berhasil diperbarui'));
        else
            $this->session->set_flashdata('msg', alert_error('Data gagal diperbarui'));

        redirect('jenis_barang/index');
    }

    public function delete_jenis_barang($id_jenis_barang)
    {
        $cek = $this->model_jenis_barang->delete_jenis_barang($id_jenis_barang);

        if ($cek)
            $this->session->set_flashdata('msg', alert_success('Data berhasil dihapus'));
        else
            $this->session->set_flashdata('msg', alert_error('Data gagal dihapus'));

        redirect('jenis_barang/index');
    }
}