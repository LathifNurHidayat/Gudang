<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        middleware_login();
        middleware_access();

        $this->load->model('model_menu');
        $this->load->model('model_submenu');
    }

    public function index()
    {
        $data['menu'] = $this->model_menu->get_all_menu();

        $this->load->view("templates/header");
        $this->load->view("templates/sidebar");
        $this->load->view("menu/view_menu", $data);
        $this->load->view("templates/footer");
    }

    public function add_menu()
    {
        $this->load->view("templates/header");
        $this->load->view("templates/sidebar");
        $this->load->view("menu/add_menu");
        $this->load->view("templates/footer");
    }

    public function edit_menu($id_menu)
    {
        $data['menu'] = $this->model_menu->get_menu_by_id($id_menu);

        $this->load->view("templates/header");
        $this->load->view("templates/sidebar");
        $this->load->view("menu/edit_menu", $data);
        $this->load->view("templates/footer");
    }


    public function insert_menu()
    {
        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('menu/add_menu');
            $this->load->view('templates/footer');
            return;
        }

        $data = [
            'menu' => $this->input->post('menu', TRUE),
        ];

        $query_cek = $this->model_menu->insert_menu($data);
        if ($query_cek)
            $this->session->set_flashdata('msg', alert_success('Data berhasil disimpan'));
        else
            $this->session->set_flashdata('msg', alert_error('Data gagal disimpan'));

        redirect('menu/index');
    }


    public function update_menu()
    {
        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('menu/edit_menu');
            $this->load->view('templates/footer');
            return;
        }

        $id_menu = $this->input->post('id_menu', TRUE);

        $data = [
            'menu' => $this->input->post('menu', TRUE),
        ];

        $query_cek = $this->model_menu->update_menu($id_menu, $data);
        if ($query_cek)
            $this->session->set_flashdata('msg', alert_success('Data berhasil diperbarui'));
        else
            $this->session->set_flashdata('msg', alert_error('Data gagal diperbarui'));

        redirect('menu/index');
    }


    //SUBMENU
    public function submenu()
    {
        $data['submenu'] = $this->model_submenu->get_all_submenu();

        $this->load->view("templates/header");
        $this->load->view("templates/sidebar");
        $this->load->view("submenu/view_submenu", $data);
        $this->load->view("templates/footer");
    }

    public function add_submenu()
    {
        $data['menu'] = $this->model_menu->get_all_menu();

        $this->load->view("templates/header");
        $this->load->view("templates/sidebar");
        $this->load->view("submenu/add_submenu", $data);
        $this->load->view("templates/footer");
    }

    public function edit_submenu($id_submenu)
    {
        $data['submenu'] = $this->model_submenu->get_submenu_by_id($id_submenu);
        $data['menu'] = $this->model_menu->get_all_menu();

        $this->load->view("templates/header");
        $this->load->view("templates/sidebar");
        $this->load->view("submenu/edit_submenu", $data);
        $this->load->view("templates/footer");
    }

    public function insert_submenu()
    {
        $this->form_validation->set_rules('id_menu', 'Menu', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        $this->form_validation->set_rules('is_active', 'Is Active', 'required');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('submenu/add_submenu');
            $this->load->view('templates/footer');
            return;
        }

        $data = [
            'id_menu' => $this->input->post('id_menu', TRUE),
            'title' => $this->input->post('title', TRUE),
            'url' => $this->input->post('url', TRUE),
            'icon' => $this->input->post('icon', TRUE),
            'is_active' => $this->input->post('is_active', TRUE),
        ];

        $query_cek = $this->model_submenu->insert_submenu($data);
        if ($query_cek)
            $this->session->set_flashdata('msg', alert_success('Data berhasil disimpan'));
        else
            $this->session->set_flashdata('msg', alert_error('Data gagal disimpan'));

        redirect('menu/submenu');
    }


    public function update_submenu()
    {
        $id_submenu = $this->input->post('id_sub_menu', TRUE);

        $this->form_validation->set_rules('id_menu', 'Menu', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        $this->form_validation->set_rules('is_active', 'Is Active', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['submenu'] = $this->model_submenu->get_submenu_by_id($id_submenu);
            $data['menu'] = $this->model_menu->get_all_menu();
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('submenu/edit_submenu', $data);
            $this->load->view('templates/footer');
            return;
        }

        $data = [
            'id_menu' => $this->input->post('id_menu', TRUE),
            'title' => $this->input->post('title', TRUE),
            'url' => $this->input->post('url', TRUE),
            'icon' => $this->input->post('icon', TRUE),
            'is_active' => $this->input->post('is_active', TRUE),
        ];

        $query_cek = $this->model_submenu->update_submenu($id_submenu, $data);
        if ($query_cek)
            $this->session->set_flashdata('msg', alert_success('Data berhasil diperbarui'));
        else
            $this->session->set_flashdata('msg', alert_error('Data gagal diperbarui'));

        redirect('menu/submenu');
    }
}