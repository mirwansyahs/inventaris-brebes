<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_lima_tahun extends CI_Controller
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
			'title'    => 'Barang > 5 Tahun',
			'sidebar'  => 'admin/sidebar',
			'page'     => 'admin/barang_lima_tahun',
			'barang'    => $this->admin->getBarangKeluar([
				'YEAR(barangKeluar.tanggalKeluar) <=' => $th_lalu
			], 'barangKeluar.kodeBarang')
		];

		$this->load->view('index', $data);
	}
}

/* End of file Barang_lima_tahun.php */
