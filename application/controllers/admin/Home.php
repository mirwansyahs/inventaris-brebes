<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
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
        $th_ini = date('Y');
        $tahun = strtotime($th_ini);
        $th_lalu = date('Y', strtotime("-5 years", $tahun));

        $data = [
            'title'     => 'Dashboard',
            'sidebar'   => 'admin/sidebar',
            'page'      => 'admin/dashboard',
            'user'      => $this->admin->get('user')->num_rows(),
            'distribusi'      => $this->admin->get('distribusi')->num_rows(),
            'barangMasuk'      => $this->admin->get('barangMasuk')->num_rows(),
            'barangRusak'      => $this->admin->get('barangRusak')->num_rows(),
            'kategori'      => $this->admin->get('kategori')->num_rows(),
            'helpdesk'      => $this->admin->get('helpdesk')->num_rows(),
            'barangLimaTahun'   => $this->admin->getBarangKeluar([
                'YEAR(barangKeluar.tanggalKeluar) <=' => $th_lalu
            ], 'barangKeluar.kodeBarang')
        ];

        $this->load->view('index', $data);
    }
}

/* End of file Admin.php */
