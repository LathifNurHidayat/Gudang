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
        $this->load->view("templates/header");
        $this->load->view("templates/sidebar");
        $this->load->view("user/view_user");
        $this->load->view("templates/footer");
    }

    public function get_user()
    {
        $keyword = $this->input->post('keyword');
        $user = $this->model_user->get_all_user($keyword);
        echo json_encode($user);
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
        $file_name = 'Default.png';
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2048;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('profile')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('msg', alert_error($error));
            $data['user'] = $this->model_user->get_user_by_id($id_user);

            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('user/edit_user', $data);
            $this->load->view('templates/footer');
            return;
        }
        $profile = $this->db->get_where('tb_user', ['id_user' => $id_user])->row_array();
        $old_profile = $profile['profile'];
        if ($old_profile && file_exists('./uploads/'.$old_profile) && $old_profile != 'Default.png'){
            unlink('./uploads/'.$old_profile);
        }

        $file = $this->upload->data();
        $file_name = $file['file_name'];
        $data = [
            'username' => $this->input->post('username', TRUE),
            'fullname' => $this->input->post('fullname', TRUE),
            'is_active' => $this->input->post('is_active', TRUE),
            'profile' => $file_name
        ];

        $query_cek = $this->model_user->update_user($id_user, $data);
        if ($query_cek)
            $this->session->set_flashdata('msg', alert_success('Data berhasil diperbarui'));
        else
            $this->session->set_flashdata('msg', alert_error('Data gagal diperbarui'));

        redirect('user/index');
    }



}