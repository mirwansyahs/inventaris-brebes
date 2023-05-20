<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Helpdesk extends CI_Controller
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
            'title'     => 'Helpdesk',
            'sidebar'   => 'user/sidebar',
            'page'      => 'user/helpdesk',
            'barang'    => $this->user->getBarangInventaris([
                'barangKeluar.idDistribusi' => $this->dt_user->idDistribusi
            ]),
            'helpdesk' => $this->user->getHelpdesk([
                'helpdesk.idUser' => $this->dt_user->id
            ]),
        ];

        $this->load->view('index', $data);
    }

    public function add()
    {
        $barang = $this->user->getBarangInventaris([
            'barangKeluar.id' => $this->input->post('idBarangKeluar')
        ]);

        if ($barang[0]->jumlahKeluar < $this->input->post('jumlahBarang')) {
            $this->session->set_flashdata('toastr-error', 'Jumlah barang tidak boleh melebihi stok');

            redirect('user/helpdesk', 'refresh');
        }

        $data = [
            'idBarangKeluar' => $this->input->post('idBarangKeluar'),
            'idUser'         => $this->dt_user->id,
            'jumlahBarang'   => $this->input->post('jumlahBarang'),
            'keterangan'     => $this->input->post('keterangan'),
            'tanggal'        => $this->input->post('tanggal'),
            'status'         => 'Menunggu'
        ];

        $insert = $this->db->insert('helpdesk', $data);

        if ($insert) {
            $this->session->set_flashdata('toastr-success', 'Sukses tambah data');
        } else {
            $this->session->set_flashdata('toastr-error', 'Gagal tambah data');
        }

        redirect('user/helpdesk', 'refresh');
    }

    public function edit()
    {
        $barang = $this->user->getBarangInventaris([
            'barangKeluar.id' => $this->input->post('idBarangKeluar')
        ]);

        if ($barang[0]->jumlahKeluar < $this->input->post('jumlahBarang')) {
            $this->session->set_flashdata('toastr-error', 'Jumlah barang tidak boleh melebihi stok');

            redirect('user/helpdesk', 'refresh');
        }

        $data = [
            'jumlahBarang'   => $this->input->post('jumlahBarang'),
            'keterangan'     => $this->input->post('keterangan'),
            'tanggal'        => $this->input->post('tanggal'),
            'status'         => 'Menunggu'
        ];

        $this->db->where('id', $this->input->post('id'));
        $update = $this->db->update('helpdesk', $data);

        if ($update) {
            $this->session->set_flashdata('toastr-success', 'Sukses tambah data');
        } else {
            $this->session->set_flashdata('toastr-error', 'Gagal tambah data');
        }

        redirect('user/helpdesk', 'refresh');
    }

    public function delete($id)
    {
        $delete =    $this->db->delete('helpdesk', ['id' => $id]);

        if ($delete) {
            $this->session->set_flashdata('toastr-success', 'Sukses hapus data');
        } else {
            $this->session->set_flashdata('toastr-error', 'Gagal hapus data');
        }

        redirect('user/helpdesk', 'refresh');
    }
}

/* End of file Admin.php */
