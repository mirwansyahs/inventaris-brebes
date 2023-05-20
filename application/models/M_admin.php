<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model
{
    public function get($table)
    {
        return $this->db->get($table);
    }

    public function getUser($where = null)
    {
        $this->db->select('user.*, distribusi.distribusi');
        $this->db->join('distribusi', 'distribusi.id = user.idDistribusi', 'left');

        if ($where) {
            $this->db->where($where);
        }

        $this->db->order_by('user.name', 'asc');

        return $this->db->get('user')->result();
    }

    public function getKategori()
    {
        $this->db->order_by('namaKategori', 'asc');
        return $this->db->get('kategori')->result();
    }

    public function getDistribusi()
    {
        $this->db->order_by('distribusi', 'asc');
        return $this->db->get('distribusi')->result();
    }

    public function getOneKategori($where)
    {
        $this->db->where($where);
        return $this->db->get('kategori')->row();
    }

    public function getOneMaxKodeBarang($where)
    {
        $this->db->select('MAX(kodeBarang) as kodeBarang');
        $this->db->where($where);

        return $this->db->get('barangMasuk')->row();
    }

    public function getBarangMasuk($where = null)
    {
        $this->db->select('barangMasuk.*, kategori.namaKategori');
        $this->db->join('kategori', 'kategori.id = barangMasuk.kategoriBarang', 'inner');

        if ($where) {
            $this->db->where($where);
        }

        $this->db->order_by('kategori.namaKategori, barangMasuk.kodeBarang', 'asc');

        return $this->db->get('barangMasuk')->result();
    }

    public function getBarangKeluar($where = null, $group = null)
    {
        $this->db->select('barangKeluar.*, barangMasuk.namaBarang, barangMasuk.stok, barangMasuk.gambar, barangMasuk.tanggalMasuk, barangMasuk.codeQR, kategori.namaKategori, distribusi.distribusi');
        $this->db->join('barangMasuk', 'barangMasuk.kodeBarang = barangKeluar.kodeBarang', 'inner');
        $this->db->join('kategori', 'kategori.id = barangMasuk.kategoriBarang', 'inner');
        $this->db->join('distribusi', 'distribusi.id = barangKeluar.idDistribusi', 'inner');

        if ($where) {
            $this->db->where($where);
        }

        if ($group) {
            $this->db->group_by($group);
        }

        $this->db->order_by('barangKeluar.tanggalKeluar', 'desc');

        return $this->db->get('barangKeluar')->result();
    }

    public function getHelpdesk($where = null)
    {
        $this->db->select('helpdesk.*, user.name, distribusi.distribusi, barangKeluar.kodeBarang, barangKeluar.jumlahKeluar, barangMasuk.namaBarang');
        $this->db->join('user', 'user.id = helpdesk.idUser', 'inner');
        $this->db->join('barangKeluar', 'barangKeluar.id = helpdesk.idBarangKeluar', 'inner');
        $this->db->join('barangMasuk', 'barangMasuk.kodeBarang = barangKeluar.kodeBarang', 'inner');
        $this->db->join('distribusi', 'distribusi.id = barangKeluar.idDistribusi', 'inner');

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

/* End of file M_admin.php */
