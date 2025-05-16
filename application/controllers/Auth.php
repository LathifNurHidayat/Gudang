<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_user');
    }


    public function form_login()
    {
        if ($this->session->userdata('is_login') == true) {
            redirect('dashboard');
        }
        $this->load->view('auth/login');
    }


    public function form_register()
    {
        $this->load->view('auth/register');
    }


    public function cek_login()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login');
            return;
        }

        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);

        $user = $this->model_user->get_user_by_username($username);

        if (!$user || !password_verify($password, $user->password)) {
            $this->session->set_flashdata('msg', alert_warning('Username atau password salah.'));
            redirect('auth/form_login');
        }

        if ($user->is_active != 'aktif') {
            $this->session->set_flashdata('msg', alert_warning('Akun belum aktif, silakan hubungi petugas'));
            redirect('auth/form_login');
        }

        $save_session = [
            'username' => $user->fullname,
            'is_login' => true,
            'role' => $user->role,
        ];

        $this->session->set_userdata($save_session);
        redirect('dashboard');
    }


    public function cek_register()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('fullname', 'Nama Lengkap', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/register');
            return;
        }

        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);
        $fullname = $this->input->post('fullname', TRUE);

        if ($this->model_user->get_user_by_username($username)) {
            $this->session->set_flashdata('msg', alert_warning('Username sudah terdaftar.'));
            redirect('auth/form_register');
        }

        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $data = [
            'username' => $username,
            'password' => $password_hash,
            'fullname' => $fullname,
            'is_active' => 'nonaktif',
            'role' => 'user',
        ];
        $this->model_user->insert_user($data);

        $this->session->set_flashdata('msg', alert_success('Registrasi berhasil, silakan login.'));
        redirect('auth/form_login');
    }


    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/form_login');
    }
}