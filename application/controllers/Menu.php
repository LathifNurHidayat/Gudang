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
        $this->load->model('model_role');
    }

    public function index()
    {
        $data['menu'] = $this->model_menu->get_all_menu('');

        $this->load->view("templates/header");
        $this->load->view("templates/sidebar");
        $this->load->view("menu/view_menu", $data);
        $this->load->view("templates/footer");
    }

    public function get_menu(){
        $keyword = $this->input->post('keyword');
        $menu = $this->model_menu->get_all_menu($keyword);
        echo json_encode($menu);
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
            echo json_encode([
                'status' => 'error',
                'error_msg' => [
                    'menu' => form_error('menu'),
                ]
            ]);
            return;
        }
        $data = ['menu' => $this->input->post('menu', TRUE)];
        $query_cek = $this->model_menu->insert_menu($data);
        if ($query_cek)
            $this->session->set_flashdata('msg', alert_success('Data berhasil disimpan'));
        else
            $this->session->set_flashdata('msg', alert_error('Data gagal disimpan'));

        echo json_encode([
            'status' => 'success',
            'redirect' => site_url('menu/index')
        ]);
    }


    public function update_menu()
    {
        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'status' => 'error',
                'error_msg' => [
                    'menu' => form_error('menu'),
                ]
            ]);
            return;
        }
        $id_menu = $this->input->post('id_menu', TRUE);
        $data = ['menu' => $this->input->post('menu', TRUE),];
        $query_cek = $this->model_menu->update_menu($id_menu, $data);
        if ($query_cek)
            $this->session->set_flashdata('msg', alert_success('Data berhasil diperbarui'));
        else
            $this->session->set_flashdata('msg', alert_error('Data gagal diperbarui'));

        echo json_encode([
            'status' => 'success',
            'redirect' => site_url('menu/index')
        ]);
    }


    //SUBMENU
    public function submenu()
    {
        $this->load->view("templates/header");
        $this->load->view("templates/sidebar");
        $this->load->view("submenu/view_submenu");
        $this->load->view("templates/footer");
    }

    public function get_submenu()
    {
        $keyword = $this->input->post('keyword');
        $submenu = $this->model_submenu->get_all_submenu($keyword);
        echo json_encode($submenu);
    }

    public function add_submenu()
    {
        $data['menu'] = $this->model_menu->get_all_menu('');

        $this->load->view("templates/header");
        $this->load->view("templates/sidebar");
        $this->load->view("submenu/add_submenu", $data);
        $this->load->view("templates/footer");
    }

    public function edit_submenu($id_submenu)
    {
        $data['submenu'] = $this->model_submenu->get_submenu_by_id($id_submenu);
        $data['menu'] = $this->model_menu->get_all_menu('');

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
            echo json_encode([
                'status' => 'error',
                'error_msg' => [
                    'id_menu' => form_error('id_menu'),
                    'title' => form_error('title'),
                    'url' => form_error('url'),
                    'icon' => form_error('icon'),
                    'is_active' => form_error('is_active'),
                ],
            ]);
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

        echo json_encode([
            'status' => 'success',
            'redirect' => site_url('menu/submenu')
        ]);
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
            echo json_encode([
                'status' => 'error',
                'error_msg' => [
                    'id_menu' => form_error('id_menu'),
                    'title' => form_error('title'),
                    'url' => form_error('url'),
                    'icon' => form_error('icon'),
                    'is_active' => form_error('is_active'),
                ]
            ]);
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

        echo json_encode([
            'status' => 'success',
            'redirect' => site_url('menu/submenu')
        ]);
    }


    //ROLE
    public function get_role()
    {
        $keyword = $this->input->post('keyword');
        $role = $this->model_role->get_all_role($keyword);
        echo json_encode($role);

    }

    public function role()
    {
        $this->load->view("templates/header");
        $this->load->view("templates/sidebar");
        $this->load->view("role/view_role");
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
            echo json_encode([
                'status' => 'error',
                'error_role' => form_error('role')
            ]);
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

        echo json_encode([
            'status' => 'success',
            'redirect' => site_url('menu/role')
        ]);
        exit;
    }


    public function update_role()
    {
        $this->form_validation->set_rules('role', 'role', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'status' => 'error',
                'error_role' => form_error('role')
            ]);
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

        echo json_encode([
            'status' => 'success',
            'redirect' => site_url('menu/role')
        ]);
    }

    //USER ACCES MENU
    public function access_menu($id_role)
    {
        $data['menu'] = $this->db->get('tb_user_menu')->result_array();
        $data['id_role'] = $id_role;

        $this->load->view("templates/header");
        $this->load->view("templates/sidebar");
        $this->load->view("menu/view_access_menu", $data);
        $this->load->view("templates/footer");
    }

    public function update_access_menu()
    {
        $data['acces_menu'] = $this->db->get('tb_user_menu')->result_array();

        $this->load->view("templates/header");
        $this->load->view("templates/sidebar");
        $this->load->view("menu/view_acces_menu", $data);
        $this->load->view("templates/footer");
    }


    public function ajax_user_access()
    {
        $id_role = $this->input->post('role_id');
        $id_menu = $this->input->post('menu_id');

        $data = [
            'id_role' => $id_role,
            'id_menu' => $id_menu
        ];

        $result = $this->db->get_where('tb_user_access_menu', $data);

        if ($result->num_rows() < 1)
            $this->db->insert('tb_user_access_menu', $data);
        else {
            $this->db->where($data);
            $this->db->delete('tb_user_access_menu');
        }

        $this->session->set_flashdata('msg', alert_success('Berhasil memperbarui'));

        echo json_encode([
            'status' => 'success',
            'redirect' => site_url('menu/access_menu/' . $id_role)
        ]);
    }

}