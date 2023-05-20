<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Distribusi extends CI_Controller
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
			'title'      => 'Distribusi',
			'sidebar'    => 'admin/sidebar',
			'page'       => 'admin/distribusi',
			'distribusi' => $this->admin->getDistribusi()
		];

		$this->load->view('index', $data);
	}

	public function add()
	{
		$data = [
			'distribusi' => $this->input->post('distribusi')
		];

		$insert = $this->db->insert('distribusi', $data);

		if ($insert) {
			$this->session->set_flashdata('toastr-success', 'Sukses tambah data');
		} else {
			$this->session->set_flashdata('toastr-error', 'Gagal tambah data');
		}

		redirect('admin/distribusi', 'refresh');
	}

	public function edit()
	{
		$data = [
			'distribusi' => $this->input->post('distribusi')
		];

		$this->db->where('id', $this->input->post('id'));
		$update = $this->db->update('distribusi', $data);

		if ($update) {
			$this->session->set_flashdata('toastr-success', 'Sukses edit data');
		} else {
			$this->session->set_flashdata('toastr-error', 'Gagal edit data');
		}

		redirect('admin/distribusi', 'refresh');
	}

	public function delete($id)
	{
		$delete =	$this->db->delete('distribusi', ['id' => $id]);

		if ($delete) {
			$this->session->set_flashdata('toastr-success', 'Sukses hapus data');
		} else {
			$this->session->set_flashdata('toastr-error', 'Gagal hapus data');
		}

		redirect('admin/distribusi', 'refresh');
	}
}

/* End of file Distribusi.php */
