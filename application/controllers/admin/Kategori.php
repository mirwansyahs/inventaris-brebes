<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
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
			'title'     => 'Kategori Barang',
			'sidebar'   => 'admin/sidebar',
			'page'      => 'admin/kategori',
			'kategori' 	=> $this->admin->getKategori()
		];

		$this->load->view('index', $data);
	}

	public function add()
	{
		$data = [
			'namaKategori' => $this->input->post('namaKategori'),
			'kode'         => $this->input->post('kode')
		];

		$insert = $this->db->insert('kategori', $data);

		if ($insert) {
			$this->session->set_flashdata('toastr-success', 'Sukses tambah data');
		} else {
			$this->session->set_flashdata('toastr-error', 'Gagal tambah data');
		}

		redirect('admin/kategori', 'refresh');
	}

	public function edit()
	{
		$data = [
			'namaKategori' => $this->input->post('namaKategori'),
			'kode'         => $this->input->post('kode')
		];

		$this->db->where('id', $this->input->post('id'));
		$update = $this->db->update('kategori', $data);

		if ($update) {
			$this->session->set_flashdata('toastr-success', 'Sukses edit data');
		} else {
			$this->session->set_flashdata('toastr-error', 'Gagal edit data');
		}

		redirect('admin/kategori', 'refresh');
	}

	public function delete($id)
	{
		$delete =	$this->db->delete('kategori', ['id' => $id]);

		if ($delete) {
			$this->session->set_flashdata('toastr-success', 'Sukses hapus data');
		} else {
			$this->session->set_flashdata('toastr-error', 'Gagal hapus data');
		}

		redirect('admin/kategori', 'refresh');
	}
}

/* End of file Kategori.php */
