<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        middleware_login();
        middleware_access();

        $this->load->model("model_barang");
        $this->load->model("model_jenis_barang");
    }


    public function index()
    {
        $data['barang'] = $this->model_barang->get_all_barang();

        $this->load->view("templates/header");
        $this->load->view("templates/sidebar");
        $this->load->view("barang/view_barang", $data);
        $this->load->view("templates/footer");
    }


    public function add_barang()
    {
        $data['jenis_barang'] = $this->model_jenis_barang->get_all_jenis_barang();

        $this->load->view("templates/header");
        $this->load->view("templates/sidebar");
        $this->load->view("barang/add_barang", $data);
        $this->load->view("templates/footer");
    }


    public function edit_barang($id_barang)
    {
        $data['barang'] = $this->model_barang->get_barang_by_id($id_barang);
        $data['jenis_barang'] = $this->model_jenis_barang->get_all_jenis_barang();

        $this->load->view("templates/header");
        $this->load->view("templates/sidebar");
        $this->load->view("barang/edit_barang", $data);
        $this->load->view("templates/footer");
    }


    public function insert_barang()
    {
        $this->form_validation->set_rules('id_jenis_barang', 'Jenis barang', 'required');
        $this->form_validation->set_rules('nama_barang', 'Nama barang', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('barang/add_barang');
            $this->load->view('templates/footer');
            return;
        }

        $data = [
            'id_jenis_barang' => $this->input->post('id_jenis_barang', TRUE),
            'nama_barang' => $this->input->post('nama_barang', TRUE),
            'harga' => $this->input->post('harga', TRUE),
            'stok' => $this->input->post('stok', TRUE),
        ];

        $query_cek = $this->model_barang->insert_barang($data);
        if ($query_cek)
            $this->session->set_flashdata('msg', alert_success('Data berhasil disimpan'));
        else
            $this->session->set_flashdata('msg', alert_error('Data gagal disimpan'));

        redirect('barang/index');
    }


    public function update_barang()
    {
        $this->form_validation->set_rules('id_jenis_barang', 'Jenis barang', 'required');
        $this->form_validation->set_rules('nama_barang', 'Nama barang', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {

            $data['jenis_barang'] = $this->model_jenis_barang->get_all_jenis_barang();

            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('barang/edit_barang', $data);
            $this->load->view('templates/footer');
            return;
        }

        $id_barang = $this->input->post('id_barang', TRUE);

        $data = [
            'id_jenis_barang' => $this->input->post('id_jenis_barang', TRUE),
            'nama_barang' => $this->input->post('nama_barang', TRUE),
            'harga' => $this->input->post('harga', TRUE),
            'stok' => $this->input->post('stok', TRUE),
        ];

        $query_cek = $this->model_barang->update_barang($id_barang, $data);
        if ($query_cek)
            $this->session->set_flashdata('msg', alert_success('Data berhasil diperbarui'));
        else
            $this->session->set_flashdata('msg', alert_error('Data gagal diperbarui'));

        redirect('barang/index');
    }


    public function delete_barang($id_barang)
    {
        $cek = $this->model_barang->delete_barang($id_barang);

        if ($cek)
            $this->session->set_flashdata('msg', alert_success('Data berhasil dihapus'));
        else
            $this->session->set_flashdata('msg', alert_error('Data gagal dihapus'));

        redirect('barang/index');
    }


    public function export_to_excel()
    {
        $this->form_validation->set_rules('tanggal_1', 'Tanggal', 'required');
        $this->form_validation->set_rules('tanggal_2', 'Tanggal', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['barang'] = $this->model_barang->get_all_barang();

            $this->load->view("templates/header");
            $this->load->view("templates/sidebar");
            $this->load->view("barang/view_barang", $data);
            $this->load->view("templates/footer");
        }
    }




    //JENIS BARANG 

    public function jenis_barang()
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

        redirect('barang/jenis_barang');
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

        redirect('barang/jenis_barang');
    }

    public function delete_jenis_barang($id_jenis_barang)
    {
        $cek = $this->model_jenis_barang->delete_jenis_barang($id_jenis_barang);

        if ($cek)
            $this->session->set_flashdata('msg', alert_success('Data berhasil dihapus'));
        else
            $this->session->set_flashdata('msg', alert_error('Data gagal dihapus'));

        redirect('barang/jenis_barang');
    }
}