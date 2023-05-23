<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin', 'admin');
    }

	public function scanqr()
	{
		$inputData = $this->input->post();
		$inputData = explode("/", $inputData['url']);
		$kodeBarang = dekrip(end($inputData));

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

        header('content-type: application/json');

        echo json_encode($data);

	}

    public function getKategoriBarang()
    {
        $dataKategori = $this->admin->getKategori();

        header('content-type: application/json');
        echo json_encode($dataKategori);
    }

    public function addBarangMasuk()
    {
        $kodeBarang = $this->_kodeBarang($this->input->post('kategoriBarang'));

        $codeQR = $this->_codeQR($kodeBarang);

        $data = [
            'kategoriBarang' => $this->input->post('kategoriBarang'),
            'kodeBarang'     => $kodeBarang,
            'namaBarang'     => $this->input->post('namaBarang'),
            'tanggalMasuk'   => $this->input->post('tanggalMasuk'),
            'stok'           => $this->input->post('stok'),
            'gambar'         => "",
            'codeQR'         => $codeQR
        ];

        $insert = $this->db->insert('barangMasuk', $data);

        if ($insert) {
            $status = true;
            $msg = "Berhasil tambah data";
        } else {
            $status = false;
            $msg = "Gagal tambah data";
        }

        header('content-type: application/json');
        echo json_encode(array(
            'message'   => $msg,
            'status'    => $status
        ));
    }
    
    private function _kodeBarang($kategoriBarang)
    {
        $kategori = $this->admin->getOneKategori([
            'id' => $kategoriBarang
        ]);

        $cek = $this->admin->getOneMaxKodeBarang([
            'kategoriBarang' => $kategori->id
        ]);

        if ($cek) {
            $a = $cek->kodeBarang;
            $newstring = substr($a, -4);
            $urut = (int)$newstring;

            $urut += 1;
            if (strlen($urut) == 1) {
                $urut = '000' . ($urut);
            } else if ((strlen($urut) == 2)) {
                $urut = '00' . ($urut);
            } else if ((strlen($urut) == 3)) {
                $urut = '0' . ($urut);
            } else {
                $urut = $urut;
            }
        } else {
            $urut = '0001';
        }

        return $kategori->kode . '-' . $urut;
    }

    private function _codeQR($kodeBarang)
    {
        $namaFile           = "qrcode-" . date('YmdHis') . ".png";
        $url                = "scan/" . enkrip($kodeBarang);
        $params['data']     = base_url($url);
        $params['level']    = 'H';
        $params['size']     = 10;
        $params['savename'] = "uploads/qr/$namaFile";

        $this->load->library('Ciqrcode');
        $this->ciqrcode->generate($params);

        return $namaFile;
    }
}

/* End of file Scan.php */
