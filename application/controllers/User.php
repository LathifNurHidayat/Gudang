<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        middleware_login();
        middleware_access();

        $this->load->model("model_user");
        $this->load->model("model_role");
    }

    public function index()
    {
        $data['user'] = $this->model_user->get_all_user();

        $this->load->view("templates/header");
        $this->load->view("templates/sidebar");
        $this->load->view("user/view_user", $data);
        $this->load->view("templates/footer");
    }

    public function add_user()
    {
        $this->load->view("templates/header");
        $this->load->view("templates/sidebar");
        $this->load->view("user/add_user");
        $this->load->view("templates/footer");
    }

    public function edit_user($id_user)
    {
        $data['user'] = $this->model_user->get_user_by_id($id_user);

        $this->load->view("templates/header");
        $this->load->view("templates/sidebar");
        $this->load->view("user/edit_user", $data);
        $this->load->view("templates/footer");
    }

    public function insert_user()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('fullname', 'Nama lengkap', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('user/add_user');
            $this->load->view('templates/footer');
            return;
        }

        $data = [
            'username' => $this->input->post('username', TRUE),
            'fullname' => $this->input->post('fullname', TRUE),
            'password' => $this->input->post('password', TRUE),
        ];

        $query_cek = $this->model_user->insert_user($data);
        if ($query_cek)
            $this->session->set_flashdata('msg', alert_success('Data berhasil disimpan'));
        else
            $this->session->set_flashdata('msg', alert_error('Data gagal disimpan'));

        redirect('user/index');
    }

    public function update_user()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('fullname', 'Nama lengkap', 'required');

        if ($this->form_validation->run() == FALSE) {
            $id_user = $this->input->post('id_user');
            $data['user'] = $this->model_user->get_user_by_id($id_user);

            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('user/edit_user', $data);
            $this->load->view('templates/footer');
            return;
        }

        $id_user = $this->input->post('id_user', TRUE);

        $data = [
            'username' => $this->input->post('username', TRUE),
            'fullname' => $this->input->post('fullname', TRUE),
            'is_active' => $this->input->post('is_active', TRUE),
        ];

        $query_cek = $this->model_user->update_user($id_user, $data);
        if ($query_cek)
            $this->session->set_flashdata('msg', alert_success('Data berhasil diperbarui'));
        else
            $this->session->set_flashdata('msg', alert_error('Data gagal diperbarui'));

        redirect('user/index');
    }


    //ROLE
    public function role()
    {
        $data['role'] = $this->model_role->get_all_role();

        $this->load->view("templates/header");
        $this->load->view("templates/sidebar");
        $this->load->view("role/view_role", $data);
        $this->load->view("templates/footer");
    }

    public function add_role()
    {
        $this->load->view("templates/header");
        $this->load->view("templates/sidebar");
        $this->load->view("role/add_role");
        $this->load->view("templates/footer");
    }

    public function edit_role($id_role)
    {
        $data['role'] = $this->model_role->get_role_by_id($id_role);

        $this->load->view("templates/header");
        $this->load->view("templates/sidebar");
        $this->load->view("role/edit_role", $data);
        $this->load->view("templates/footer");
    }

    public function insert_role()
    {
        $this->form_validation->set_rules('role', 'role', 'required');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('role/add_role');
            $this->load->view('templates/footer');
            return;
        }

        $data = [
            'role' => $this->input->post('role', TRUE),
        ];

        $query_cek = $this->model_role->insert_role($data);
        if ($query_cek)
            $this->session->set_flashdata('msg', alert_success('Data berhasil disimpan'));
        else
            $this->session->set_flashdata('msg', alert_error('Data gagal disimpan'));

        redirect('role');
    }


    public function update_role()
    {
        $this->form_validation->set_rules('role', 'role', 'required');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('role/edit_role');
            $this->load->view('templates/footer');
            return;
        }

        $id_role = $this->input->post('id_role', TRUE);

        $data = [
            'role' => $this->input->post('role', TRUE),
        ];

        $query_cek = $this->model_role->update_role($id_role, $data);
        if ($query_cek)
            $this->session->set_flashdata('msg', alert_success('Data berhasil diperbarui'));
        else
            $this->session->set_flashdata('msg', alert_error('Data gagal diperbarui'));

        redirect('role');
    }
}