<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{
	public function get($table)
	{
		return $this->db->get($table);
	}

	public function getBarangInventaris($where)
	{
		$this->db->select('barangKeluar.*, barangMasuk.namaBarang, barangMasuk.gambar, barangMasuk.codeQR, kategori.namaKategori');
		$this->db->join('barangMasuk', 'barangMasuk.kodeBarang = barangKeluar.kodeBarang', 'inner');
		$this->db->join('kategori', 'kategori.id = barangMasuk.kategoriBarang', 'inner');

		if ($where) {
			$this->db->where($where);
		}

		$this->db->order_by('barangKeluar.tanggalKeluar', 'desc');

		return $this->db->get('barangKeluar')->result();
	}

	public function getHelpdesk($where)
	{
		$this->db->select('helpdesk.*, barangKeluar.kodeBarang, barangKeluar.jumlahKeluar, barangMasuk.namaBarang');
		$this->db->join('barangKeluar', 'barangKeluar.id = helpdesk.idBarangKeluar', 'inner');
		$this->db->join('barangMasuk', 'barangMasuk.kodeBarang = barangKeluar.kodeBarang', 'inner');

		if ($where) {
			$this->db->where($where);
		}

		$this->db->order_by('helpdesk.tanggal', 'desc');

		return $this->db->get('helpdesk')->result();
	}

	public function getBarangRusak($where = null)
	{
		$this->db->select('barangRusak.*, helpdesk.jumlahBarang, helpdesk.keterangan, distribusi.distribusi, barangKeluar.kodeBarang, barangKeluar.jumlahKeluar, barangMasuk.namaBarang');

		$this->db->join('helpdesk', 'helpdesk.id = barangRusak.idHelpdesk', 'inner');
		$this->db->join('barangKeluar', 'barangKeluar.id = helpdesk.idBarangKeluar', 'inner');
		$this->db->join('barangMasuk', 'barangMasuk.kodeBarang = barangKeluar.kodeBarang', 'inner');
		$this->db->join('distribusi', 'distribusi.id = barangKeluar.idDistribusi', 'inner');

		if ($where) {
			$this->db->where($where);
		}

		$this->db->order_by('helpdesk.tanggal', 'desc');

		return $this->db->get('barangRusak')->result();
	}
}

/* End of file M_user.php */
