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
        if (@$inputData){
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
                $message = "Barang ditemukan";
                $status = true;
            } else {
                $barang = null;
                $riwayat = null;
                $status = false;
                $message = "Kode barang tidak ditemukan";
            }
        }else{
            $barang = null;
            $riwayat = null;
            $status = false;
            $message = "Parameter URL tidak dikirim";

        }

		$data = [
			'title'   => 'Scan Detail Barang',
			'barang'  => $barang,
			'riwayat' => $riwayat,
            'message' => $message,
            'status'    => $status
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
        $dataInput = $this->input->post();

        if (@$dataInput){
            $kodeBarang = $this->_kodeBarang($dataInput['kategoriBarang']);

            $codeQR = $this->_codeQR($kodeBarang);

            $data = [
                'kategoriBarang' => $dataInput['kategoriBarang'],
                'kodeBarang'     => $kodeBarang,
                'namaBarang'     => $dataInput['namaBarang'],
                'tanggalMasuk'   => $dataInput['tanggalMasuk'],
                'stok'           => $dataInput['stok'],
                'gambar'         => "",
                'codeQR'         => $codeQR
            ];

            $insert = $this->db->insert('barangMasuk', $data);

            if ($insert) {
                $dataResult = $this->db->get_where('barangMasuk', ['kodeBarang' => $data['kodeBarang']])->row();
                $status = true;
                $dataResult = null;
                $msg = "Berhasil tambah data";
            } else {
                $status = false;
                $dataResult = null;
                $msg = "Gagal tambah data";
            }
        }else{
            $status = false;
            $dataResult = null;
            $msg = "Gagal tambah data, silahkan ini form.";
        }

        header('content-type: application/json');
        echo json_encode(array(
            'message'   => $msg,
            'status'    => $status,
            'data'      => $dataResult
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
