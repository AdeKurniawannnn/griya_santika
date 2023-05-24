<?php defined('BASEPATH') or exit('No direct script access allowed');

class registrasi_user extends CI_Controller
{
    public function index()
    {
        $data = array(
            'judul' => 'test',
            'css'   => array(),
            'js'    => array(),
        );
        $this->load->view('tamplates/header_user');
        $this->load->view('user/Register', $data);
        $this->load->view('tamplates/footer_user');
    }
    public function insert()
    {
        if ($this->session->userdata('email')) {
            //redirect('user');
        }
        //membuat rule untuk inputan nama agar tidak boleh kosong dengan membuat pesan error dengan 
        //bahasa sendiri yaitu 'Nama Belum diisi'
        $this->form_validation->set_rules('nama_user', 'Nama Lengkap', 'required', ['required' => 'Nama Belum diis!!']);
        //membuat rule untuk inputan email agar tidak boleh kosong, tidak ada spasi, format email harus valid
        //dan email belum pernah dipakai sama user lain dengan membuat pesan error dengan bahasa sendiri 
        //yaitu jika format email tidak benar maka pesannya 'Email Tidak Benar!!'. jika email belum diisi,
        //maka pesannya adalah 'Email Belum diisi', dan jika email yang diinput sudah dipakai user lain,
        //maka pesannya 'Email Sudah dipakai'
        $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|valid_email|is_unique[admin.email]', [
            'valid_email' => 'Email Tidak Benar!!',
            'required' => 'Email Belum diisi!!',
            'is_unique' => 'Email Sudah Terdaftar!'
        ]);
        //membuat rule untuk inputan password agar tidak boleh kosong, tidak ada spasi, tidak boleh kurang dari
        //dari 3 digit, dan password harus sama dengan repeat password dengan membuat pesan error dengan 
        //bahasa sendiri yaitu jika password dan repeat password tidak diinput sama, maka pesannya
        //'Password Tidak Sama'. jika password diisi kurang dari 3 digit, maka pesannya adalah 
        //'Password Terlalu Pendek'.
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password Tidak Sama!!',
            'min_length' => 'Password Terlalu Pendek'
        ]);
        $this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|matches[password1]');
        //jika jida disubmit kemudian validasi form diatas tidak berjalan, maka akan tetap berada di
        //tampilan registrasi. tapi jika disubmit kemudian validasi form diatas berjalan, maka data yang 
        //diinput akan disimpan ke dalam tabel user
        $email = $this->input->post('email', true);
        $data = [
            'nama_user' => htmlspecialchars($this->input->post('nama', true)),
            'email' => htmlspecialchars($email),
            // 'image' => 'default.jpg',
            'password1' => md5($this->input->post('password1')),
            'password2' => $this->input->post('password2'),
            // 'role_id' => 1,
            'is_active' => 1,
            // 'tanggal_input' => time()
        ];
        $this->load->model('modeluser');
        $this->modeluser->simpanData($data); //menggunakan model

        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Selamat!! akun member anda sudah dibuat. Silahkan Aktivasi Akun anda</div>');
        redirect('login');
    }
}
