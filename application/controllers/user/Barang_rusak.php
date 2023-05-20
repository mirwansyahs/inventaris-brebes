<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_rusak extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('log_user'))) {
            $this->session->set_flashdata('toastr-error', 'Anda Belum Login');
            redirect('auth', 'refresh');
        }

        $this->db->where('id', $this->session->userdata('id'));
        $this->dt_user = $this->db->get('user')->row();

        $this->load->model('M_user', 'user');
    }

    public function index()
    {
        $data = [
            'title'     => 'Barang Rusak',
            'sidebar'   => 'user/sidebar',
            'page'      => 'user/barang_rusak',
            'barang'    => $this->user->getBarangRusak([
                'barangKeluar.idDistribusi' => $this->dt_user->idDistribusi
            ])
        ];

        $this->load->view('index', $data);
    }
}

/* End of file Admin.php */
