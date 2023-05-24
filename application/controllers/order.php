<?php defined('BASEPATH') or exit('No direct script access allowed');

class order extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        login_user();
        $this->load->model('model_order');
    }

    public function login()
    {
        $data = array(
            'judul' => 'test',
            'css'   => array(),
            'js'    => array(),
        );
        $this->load->view('tamplates/header_user');
        $this->load->view('user/Login', $data);
        $this->load->view('tamplates/footer_user');
    }
    public function index()
    {
        //echo '<pre>', print_r($this->db->affected_rows()), '</pre>';
        //echo "<script>alert('Sukses Mengirim Pesan');</script>";
        // $this->load->view('template/header');
        $this->load->view('user/form_beli');
        // $this->load->view('template/footer');
    }
    public function insert()
    {
        $data = array(
            'nama_user' => $this->input->post('nama'),
            'no_telp' => $this->input->post('notelp'),
            'email' => $this->input->post('email'),
            'type' => $this->input->post('pilih'),
            'date' => $this->input->post('janjian'),
            'status' => $this->input->post('status'),
            'Jumlah_Di_Pesan' => $this->input->post('dibeli')
        );
        $this->model_order->order($data);
        if ($this->db->affected_rows() > 0) {
            //echo '<pre>', print_r($this->db->affected_rows()), '</pre>';
            //echo "<script>alert('Sukses Mengirim Pesan');</script>";
            $data = $this->session->set_flashdata('success', "Sukses Mengirim Pesan");
            $this->load->view('template/header', $data);
            $this->load->view('home_view');
            $this->load->view('template/footer');
            //redirect(base_url());
        }
    }
    public function cetak()
    {
        $id_user = $this->session->userdata('id_user');
        $data['user'] = $this->session->userdata('nama');
        $data['judul'] = "Cetak Bukti Booking";
        $data['useraktif'] = $this->ModelUser->cekData(['id' => $this->session->userdata('id_user')])->result();
        $data['items'] = $this->db->query("select*from booking bo, booking_detail 
        d, buku bu where d.id_booking=bo.id_booking and d.id_buku=bu.id and 
        bo.id_user='$id_user'")->result_array();

        $this->load->view('booking/cetak', $data);
    }
}
