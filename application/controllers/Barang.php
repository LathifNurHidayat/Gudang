<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


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
        $this->load->view("templates/header");
        $this->load->view("templates/sidebar");
        $this->load->view("barang/view_barang");
        $this->load->view("templates/footer");
    }


    public function get_barang()
    {
        $keyword = $this->input->post('keyword');
        $barang = $this->model_barang->get_all_barang($keyword);
        echo json_encode($barang);
    }

    public function add_barang()
    {
        $data['jenis_barang'] = $this->model_jenis_barang->get_all_jenis_barang('');
        $this->load->view("templates/header");
        $this->load->view("templates/sidebar");
        $this->load->view("barang/add_barang", $data);
        $this->load->view("templates/footer");
    }

    public function edit_barang($id_barang)
    {
        $data['barang'] = $this->model_barang->get_barang_by_id($id_barang);
        $data['jenis_barang'] = $this->model_jenis_barang->get_all_jenis_barang('');

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
            echo json_encode([
                'status' => 'error',
                'error_msg' => [
                    'id_jenis_barang' => form_error('id_jenis_barang'),
                    'nama_barang' => form_error('nama_barang'),
                    'harga' => form_error('harga'),
                    'stok' => form_error('stok')
                ]
            ]);
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

        echo json_encode(['status' => 'success', 'redirect' => site_url('barang/index')]);
    }


    public function update_barang()
    {
        $this->form_validation->set_rules('id_jenis_barang', 'Jenis barang', 'required');
        $this->form_validation->set_rules('nama_barang', 'Nama barang', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'status' => 'error',
                'error_msg' => [
                    'id_jenis_barang' => form_error('id_jenis_barang'),
                    'nama_barang' => form_error('nama_barang'),
                    'harga' => form_error('harga'),
                    'stok' => form_error('stok')
                ]
            ]);
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
        echo json_encode([
            'status' => 'success',
            'redirect' => site_url('barang/index')
        ]);
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
    $barang = $this->db->get('tb_barang')->result_array();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->setCellValue('A4', 'ID Barang');
    $sheet->setCellValue('B4', 'Nama Barang');
    $sheet->setCellValue('C4', 'Harga Barang');
    $sheet->setCellValue('D4', 'Stok');

    $style_header = [
        'font' => [
            'bold' => true,
            'color' => ['rgb' => 'FFFFFF'],
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => '4CAF50'],
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            ],
        ],
    ];
    $sheet->getStyle('A4:D4')->applyFromArray($style_header);

    $row = 5;
    foreach ($barang as $b) {
        $sheet->setCellValue('A' . $row, $b['id_barang']);
        $sheet->setCellValue('B' . $row, $b['nama_barang']);
        $sheet->setCellValue('C' . $row, $b['harga']);
        $sheet->setCellValue('D' . $row, $b['stok']);
        $row++;
    }

    // Styling
    $last_row = $row - 1;
    $sheet->getStyle('A5:D' . $last_row)->applyFromArray([
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            ]
        ],
    ]);

    // Lebar auto
    foreach (range('A', 'D') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    // Ekspor ke browser
    $writer = new Xlsx($spreadsheet);
    $filename = 'Data_Barang_' . date('Ymd_His');

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=\"$filename.xlsx\"");
    $writer->save('php://output');
}


    //JENIS BARANG 
    public function jenis_barang()
    {
        $data['jenis_barang'] = $this->model_jenis_barang->get_all_jenis_barang('');

        $this->load->view("templates/header");
        $this->load->view("templates/sidebar");
        $this->load->view("jenis_barang/view_jenis_barang", $data);
        $this->load->view("templates/footer");
    }


    public function get_jenis_barang()
    {
        $keyword = $this->input->post('keyword');
        $barang = $this->model_jenis_barang->get_all_jenis_barang($keyword);
        echo json_encode($barang);
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
            echo json_encode([
                'status' => 'error',
                'error_msg' => [
                    'nama_jenis_barang' => form_error('nama_jenis_barang'),
                ]
            ]);
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

        echo json_encode([
            'status' => 'success',
            'redirect' => site_url('barang/jenis_barang')
        ]);
    }


    public function update_jenis_barang()
    {
        $this->form_validation->set_rules('nama_jenis_barang', 'Jenis Barang', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'status' => 'error',
                'error_msg' => [
                    'error_jenis' => form_error('nama_jenis_barang')
                ]
            ]);
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
        echo json_encode([
            'status' => 'success',
            'redirect' => site_url('barang/jenis_barang')
        ]);
    }


    public function delete_jenis_barang()
    {
        $id_jenis_barang = $this->input->post('id_jenis_barang');
        $cek = $this->model_jenis_barang->delete_jenis_barang($id_jenis_barang);

        if ($cek)
            $this->session->set_flashdata('msg', alert_success('Data berhasil dihapus'));
        else
            $this->session->set_flashdata('msg', alert_error('Data gagal dihapus'));

        echo json_encode([
            'status' => 'success',
        ]);
    }
}