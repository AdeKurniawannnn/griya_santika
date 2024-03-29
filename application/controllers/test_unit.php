<?php
defined('BASEPATH') or exit('No direct script access allowed');

class test_unit extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelAdmin');
        $this->load->model('ModelPemesanan');
        $this->load->library('unit_test');
    }

    public function index()
    {
        $data['judul'] = 'Admin';
        $data['admin'] = $this->ModelAdmin->cekData(['email' => $this->session->userdata('email')]);
        $data['anggota'] = $this->ModelAdmin->getUserLimit()->result_array();
        $data['buku'] = $this->ModelPemesanan->getBuku()->result_array();
        $data['jumlah_pemesan'] = $this->db->count_all('buku');

        $this->load->view('template/Admin_header', $data);
        $this->load->view('template/Admin_sidebar', $data);
        $this->load->view('template/Admin_topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('template/Admin_footer');
    }
}
