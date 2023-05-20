<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_keluar extends CI_Controller
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
            'title'        => 'Barang Keluar',
            'sidebar'      => 'admin/sidebar',
            'page'         => 'admin/barang_keluar',
            'barangMasuk'  => $this->admin->getBarangMasuk(),
            'barangKeluar' => $this->admin->getBarangKeluar(),
            'distribusi'   => $this->admin->getDistribusi()
        ];

        $this->load->view('index', $data);
    }

    public function add()
    {
        $jumlahKeluar = $this->input->post('jumlahKeluar');
        $kodeBarang = $this->input->post('kodeBarang');

        $barangMasuk = $this->admin->getBarangMasuk([
            'barangMasuk.kodeBarang'    => $kodeBarang
        ]);

        if ($barangMasuk[0]->stok < $jumlahKeluar) {
            $this->session->set_flashdata('toastr-error', 'Jumlah keluar tidak boleh melebihi stok');

            redirect('admin/barang_keluar', 'refresh');
        }

        $data = [
            'kodeBarang'    => $kodeBarang,
            'jumlahKeluar'  => $this->input->post('jumlahKeluar'),
            'tanggalKeluar' => $this->input->post('tanggalKeluar'),
            'idDistribusi'    => $this->input->post('distribusi')
        ];

        $insert = $this->db->insert('barangKeluar', $data);

        if ($insert) {
            $dataBarangMasuk = [
                'stok' => ($barangMasuk[0]->stok - $jumlahKeluar)
            ];

            $this->db->where('kodeBarang', $kodeBarang);
            $this->db->update('barangMasuk', $dataBarangMasuk);

            $this->session->set_flashdata('toastr-success', 'Sukses tambah data');
        } else {
            $this->session->set_flashdata('toastr-error', 'Gagal tambah data');
        }

        redirect('admin/barang_keluar', 'refresh');
    }

    public function edit()
    {
        $id                   = $this->input->post('id');
        $jumlahKeluar         = $this->input->post('jumlahKeluar');

        $barangKeluar = $this->admin->getBarangKeluar([
            'barangKeluar.id' => $id
        ]);

        $kodeBarang = $barangKeluar[0]->kodeBarang;

        $barangMasuk = $this->admin->getBarangMasuk([
            'barangMasuk.kodeBarang'    => $kodeBarang
        ]);

        if (($barangMasuk[0]->stok + $barangKeluar[0]->jumlahKeluar) < $jumlahKeluar) {
            $this->session->set_flashdata('toastr-error', 'Jumlah keluar tidak boleh melebihi stok');

            redirect('admin/barang_keluar', 'refresh');
        }

        $data = [
            'jumlahKeluar'  => $this->input->post('jumlahKeluar'),
            'tanggalKeluar' => $this->input->post('tanggalKeluar'),
            'idDistribusi'    => $this->input->post('distribusi')
        ];

        $this->db->where('id', $id);
        $update = $this->db->update('barangKeluar', $data);

        if ($update) {
            $dataBarangMasuk = [
                'stok' => (($barangMasuk[0]->stok + $barangKeluar[0]->jumlahKeluar) - $jumlahKeluar)
            ];

            $this->db->where('kodeBarang', $kodeBarang);
            $this->db->update('barangMasuk', $dataBarangMasuk);

            $this->session->set_flashdata('toastr-success', 'Sukses edit data');
        } else {
            $this->session->set_flashdata('toastr-error', 'Gagal edit data');
        }

        redirect('admin/barang_keluar', 'refresh');
    }

    public function delete($id)
    {
        $barangKeluar = $this->admin->getBarangKeluar([
            'barangKeluar.id' => $id
        ]);

        $delete = $this->db->delete('barangKeluar', ['id' => $id]);

        if ($delete) {
            $barangMasuk = $this->admin->getBarangMasuk([
                'barangMasuk.kodeBarang'    => $barangKeluar[0]->kodeBarang
            ]);

            $dataBarangMasuk = [
                'stok' => ($barangMasuk[0]->stok + $barangKeluar[0]->jumlahKeluar)
            ];

            $this->db->where('kodeBarang', $barangKeluar[0]->kodeBarang);
            $this->db->update('barangMasuk', $dataBarangMasuk);

            $this->session->set_flashdata('toastr-success', 'Sukses hapus data');
        } else {
            $this->session->set_flashdata('toastr-error', 'Gagal hapus data');
        }

        redirect('admin/barang_keluar', 'refresh');
    }
}

/* End of file Barang_keluar.php */
