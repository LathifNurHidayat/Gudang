<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login();
        
        $this->load->model("model_barang");
        $this->load->model("model_user");
        $this->load->model("model_jenis_barang");
    }

    public function index()
    {
        $data['barang'] = $this->model_barang->count_barang();
        $data['user'] = $this->model_user->count_user();
        $data['jenis_barang'] = $this->model_jenis_barang->count_jenis_barang();

        $this->load->view("templates/header");
        $this->load->view("templates/sidebar");
        $this->load->view("dashboard/view_dashboard", $data);
        $this->load->view("templates/footer");
    }
}