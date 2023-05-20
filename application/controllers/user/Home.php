<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
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
        $this->db->where('idDistribusi', $this->dt_user->idDistribusi);
        $barang = $this->user->get('barangKeluar')->num_rows();

        $this->db->where('idUser', $this->dt_user->id);
        $helpdek = $this->user->get('helpdesk')->num_rows();

        $this->db->join('helpdesk', 'barangRusak.idHelpdesk = helpdesk.id', 'inner');
        $this->db->where('helpdesk.idUser', $this->dt_user->id);
        $barangRusak = $this->user->get('barangRusak')->num_rows();

        $data = [
            'title'       => 'Dashboard',
            'sidebar'     => 'user/sidebar',
            'page'        => 'user/dashboard',
            'barang'      => $barang,
            'helpdesk'    => $helpdek,
            'barangRusak' => $barangRusak
        ];

        $this->load->view('index', $data);
    }
}

/* End of file Admin.php */
