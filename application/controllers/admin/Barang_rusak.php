<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_rusak extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('log_admin'))) {
            $this->session->set_flashdata('toastr-error', 'Anda Belum Login');
            redirect('auth', 'refresh');
        }

        $this->db->where('id', $this->session->userdata('id'));
        $this->dt_user = $this->db->get('user')->row();

        $this->load->model('M_admin', 'admin');
    }

    public function index()
    {
        $data = [
            'title'     => 'Barang rusak',
            'sidebar'   => 'admin/sidebar',
            'page'      => 'admin/barang_rusak',
            'barang'    => $this->admin->getBarangRusak()
        ];

        $this->load->view('index', $data);
    }
}

/* End of file Barang_masuk.php */
