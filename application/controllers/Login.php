<?php defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //login_user();
        // $this->load->model('ModelAdmin');
        // $this->load->model('ModelPemesanan');
        // $this->session->keep_flashdata('success');
        // if (!$this->session->userdata('email'))
        //     redirect('Autentifikasi');
    }
    public function index()
    {

        $data['judul'] = 'Login';
        $data['admin'] = '';
        //kata 'login' merupakan nilai dari variabel judul dalam array $data dikirimkan ke view aute_header
        $this->load->view('tamplates/header_user');
        $this->load->view('user/Login', $data);
        $this->load->view('tamplates/footer_user');
    }
    public function action()
    {
        if ($this->session->userdata('email')) {
            //redirect('user');
        }
        $this->form_validation->set_rules(
            'email',
            'Alamat Email',
            'required|trim|valid_email',
            [
                'required' => 'Email Harus diisi!!',
                'valid_email' => 'Email Tidak Benar!!'
            ]
        );
        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim',
            [
                'required' => 'Password Harus diisi'
            ]
        );
        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Login';
            $data['admin'] = '';
            //kata 'login' merupakan nilai dari variabel judul dalam array $data dikirimkan ke view aute_header
            $this->load->view('tamplates/header_user');
            $this->load->view('user/Login', $data);
            $this->load->view('tamplates/footer_user');
        } else {
            $this->_login();
        }
        // $data = array(
        //     'judul' => 'test',
        //     'css'   => array(),
        //     'js'    => array(),
        // );
        // $this->load->view('tamplates/header_user');
        // $this->load->view('user/Login', $data);
        // $this->load->view('tamplates/footer_user');
    }

    private function _login()
    {

        $email = htmlspecialchars($this->input->post(
            'email',
            true
        ));

        $password = $this->input->post('password1');

        $this->load->model('modeluser');
        $admin = $this->modeluser->cekData(['email' => $email]);
        $pass = md5($this->input->post('password1'));

        //jika usernya ada
        //print_r($user);exit;
        if ($admin) {
            //jika user sudah aktif
            if ($admin['is_active'] == 1) {
                //cek password
                if ($pass == $admin['password1']) {
                    //if ($password == $user['password']) {
                    $data = [
                        'email' => $admin['email'],
                        'nama_user' => $admin['nama_user']
                    ];
                    $this->session->set_userdata($data);
                    //sspre($_SESSION);
                    redirect('order');
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Password salah!!</div>');
                    redirect('Login');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div 
class="alert alert-danger alert-message" role="alert">User belum 
diaktifasi!!</div>');
                redirect('Login');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Email tidak 
terdaftar!!</div>');
            redirect('Login');
        }
    }

    // public function registrasi()
    // {
    //     $this->load->view('tes/Register');
    // }
}
