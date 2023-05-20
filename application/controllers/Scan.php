<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Scan extends CI_Controller
{
	public function index()
	{
		$kodeBarang = dekrip($this->uri->segment(2));

		if ($kodeBarang) {
			$this->db->where('kodeBarang', false);
			$barang = $this->db->get('barangMasuk')->row();

			$this->db->select('helpdesk.*');
			$this->db->join('barangKeluar', 'barangKeluar.id = helpdesk.idBarangKeluar', ' inner');
			$this->db->join('barangMasuk', 'barangMasuk.kodeBarang = barangKeluar.kodeBarang', 'inner');

			$this->db->order_by('helpdesk.tanggal', 'desc');

			$riwayat = $this->db->get('helpdesk')->result();
		} else {
			$barang = null;
			$riwayat = null;
		}

		$data = [
			'title'   => 'Scan Detail Barang',
			'barang'  => $barang,
			'riwayat' => $riwayat
		];

		$this->load->view('scan/index', $data);
	}

	public function api()
	{
		$kodeBarang = dekrip($this->uri->segment(2));

		if ($kodeBarang) {
			$this->db->where('kodeBarang', false);
			$barang = $this->db->get('barangMasuk')->row();

			$this->db->select('helpdesk.*');
			$this->db->join('barangKeluar', 'barangKeluar.id = helpdesk.idBarangKeluar', ' inner');
			$this->db->join('barangMasuk', 'barangMasuk.kodeBarang = barangKeluar.kodeBarang', 'inner');

			$this->db->order_by('helpdesk.tanggal', 'desc');

			$riwayat = $this->db->get('helpdesk')->result();
		} else {
			$barang = null;
			$riwayat = null;
		}

		$data = [
			'title'   => 'Scan Detail Barang',
			'barang'  => $barang,
			'riwayat' => $riwayat
		];

		$this->load->view('scan/index', $data);
	}
}

/* End of file Scan.php */
