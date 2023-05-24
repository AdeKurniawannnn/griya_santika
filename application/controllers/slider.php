<?php defined('BASEPATH') or exit('No direct script access allowed');

class Slider extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->model('model_slider');
        $this->load->helper(array('form', 'url'));
        $this->session->keep_flashdata('success');
        if (!$this->session->userdata('email'))
            redirect('Autentifikasi');
    }

    public function index()
    {
        $data = array(
            'judul' => 'Slider',
            'css'   => array(),
            'js'    => array(),
            'admin' => $this->ModelAdmin->cekData(['email' => $this->session->userdata('email')]),
            'slider' => $this->model_slider->getslider()
        );

        $this->load->view('template/Admin_header', $data);
        $this->load->view('template/Admin_sidebar', $data);
        $this->load->view('template/Admin_topbar', $data);
        $this->load->view('slider/slider_view', $data);
        $this->load->view('template/Admin_footer');
    }
    public function add()
    {
        $this->form_validation->set_rules('title', 'Title', 'required|trim');

        if ($this->form_validation->run() == false) {
            // pre('Balik lagi');
            $data = array(
                'judul' => 'Add Slider',
                'css'   => array(),
                'js'    => array(),
                'admin' => $this->ModelAdmin->cekData(['email' => $this->session->userdata('email')]),
                'slider' => $this->model_slider->getslider()
            );

            $this->load->view('template/Admin_header', $data);
            $this->load->view('template/Admin_sidebar', $data);
            $this->load->view('template/Admin_topbar', $data);
            $this->load->view('slider/slider_add', $data);
            $this->load->view('template/Admin_footer');
        } else {
            if ($_FILES['image']['name'] != '') {
                // Cek jika file upload tidak kosong
                // Simpan foto ke folder
                $allowedExts = array('jpeg', 'jpg', 'gif', 'png', 'JPG', 'JPEG', 'GIF', 'PNG');
                $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $ex_name = explode(".", $_FILES['image']['name']);
                $ext = end($ex_name);
                $new_name = 'Slider-' . date('Ymdhis') . '.' . $ext;
                $config = array(
                    'upload_path'   => './images/slider',
                    'allowed_types' => 'jpg|jpeg|gif|png',
                    'file_name'     => $new_name
                );

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image') && in_array($extension, $allowedExts)) {
                    if ($_FILES['image']['size'] >= 2097152) {
                        // Cek jika file lebih besar dari 2MB, balik ke halaman Slider
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed to upload slider image, file should not be more than 2MB</div>');

                        redirect(base_url('slider'));
                    } else if (in_array($extension, $allowedExts)) {
                        // Cek jika file kalau file extension belum sesuai, balik ke halaman Slider

                        // Simpan data Slider ke database
                        $data = array(
                            'title'  => htmlspecialchars($this->input->post('title', true)),
                            'description'  => htmlspecialchars($this->input->post('description', true)),
                            'image'      => $new_name,
                            'is_active'   => 1
                        );
                        $this->model_slider->add($data);

                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profile updated successfully!</div>');
                        //action_log($this->session->userdata('username'), 'user', 'Update Account', 'Successfully Update Account');

                        redirect(base_url('slider'));
                    } else {
                        // Cek jika file upload kosong
                        $data = array(
                            'title' => 'My Profile',
                            'css'   => array('custom.css'),
                            'js'    => array(),
                            'user'  => $this->db->get_where('admin', array('email' => $this->session->userdata('email'), 'flag' => 1))->row_array()
                        );
                        $error = array('error' => $this->upload->display_errors('<small class="text-danger">', '</small>'));

                        $this->load->view('template/Admin_header', $data);
                        $this->load->view('template/Admin_sidebar');
                        $this->load->view('template/profile');
                        $this->load->view('template/Admin_footer');
                    }
                } else {
                    // Menampilkan error tipe extension
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed to upload profile picture, only "jpg/gif/png" file type allowed!</div>');
                    //action_log($this->session->userdata('username'), 'user', 'Upload Profile Picture', 'Error upload photo, wrong file extension');

                    redirect(base_url('slider'));
                }
            }
        }
    }
    public function Pemesanan()
    {
        $data = array(
            'judul' => 'Pemesanan',
            'css'   => array(),
            'js'    => array(),
            'admin' => $this->ModelAdmin->cekData(['email' => $this->session->userdata('email')]),
            'contact' => $this->ModelAdmin->getContactWhere()->result_array(),
            'pesan' => $this->ModelAdmin->getBuku()->result_array()

        );


        $this->load->view('template/Admin_header', $data);
        $this->load->view('template/Admin_sidebar', $data);
        $this->load->view('template/Admin_topbar', $data);
        $this->load->view('pemesanan/pemesanan', $data);
        $this->load->view('template/Admin_footer');
    }
    public function delete($id)
    {
        $this->model_slider->delete($id);
        redirect('slider');
    }
    public function hapuscontact($id)
    {
        // $where = array('id' => $id);
        $this->contact_model->hapuscontact($id);
        redirect('pesan/index');
    }
}
