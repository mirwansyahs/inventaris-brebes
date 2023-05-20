<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_masuk extends CI_Controller
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
            'title'    => 'Barang masuk',
            'sidebar'  => 'admin/sidebar',
            'page'     => 'admin/barang_masuk',
            'kategori' => $this->admin->getKategori(),
            'barang'    => $this->admin->getBarangMasuk()
        ];

        $this->load->view('index', $data);
    }

    public function add()
    {
        $gambar = $_FILES['gambar']['name'];

        if ($gambar) {
            $this->load->library('upload');
            $config['upload_path']   = './uploads/gambar';
            $config['allowed_types'] = 'jpg|jpeg|png';
            // $config['max_size']             = 3072; // 3 mb
            $config['remove_spaces'] = TRUE;
            $config['detect_mime']   = TRUE;
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('gambar')) {
                $this->session->set_flashdata('toastr-error', $this->upload->display_errors());

                redirect('admin/barang_masuk', 'refresh');
            } else {
                $upload_data = $this->upload->data();

                $kodeBarang = $this->_kodeBarang($this->input->post('kategoriBarang'));

                $codeQR = $this->_codeQR($kodeBarang);

                $data = [
                    'kategoriBarang' => $this->input->post('kategoriBarang'),
                    'kodeBarang'     => $kodeBarang,
                    'namaBarang'     => $this->input->post('namaBarang'),
                    'tanggalMasuk'   => $this->input->post('tanggalMasuk'),
                    'stok'           => $this->input->post('stok'),
                    'gambar'         => $upload_data['file_name'],
                    'codeQR'         => $codeQR
                ];

                $insert = $this->db->insert('barangMasuk', $data);

                if ($insert) {
                    $this->session->set_flashdata('toastr-success', 'Sukses tambah data');
                } else {
                    $this->session->set_flashdata('toastr-error', 'Gagal tambah data');
                }
            }
        } else {
            $this->session->set_flashdata('toastr-error', 'Gambar harus ada');
        }

        redirect('admin/barang_masuk', 'refresh');
    }

    public function edit()
    {
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $dataSebelumnya = $this->db->get('barangMasuk')->row();

        $gambar = $_FILES['gambar']['name'];

        if ($gambar) {
            $this->load->library('upload');
            $config['upload_path']   = './uploads/gambar';
            $config['allowed_types'] = 'jpg|jpeg|png';
            // $config['max_size']             = 3072; // 3 mb
            $config['remove_spaces'] = TRUE;
            $config['detect_mime']   = TRUE;
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('gambar')) {
                $this->session->set_flashdata('toastr-error', $this->upload->display_errors());

                redirect('admin/barang_masuk', 'refresh');
            } else {
                $upload_data = $this->upload->data();

                if ($this->input->post('kategoriBarang') != $this->input->post('kategoriBarangSebelumnya')) {
                    $kodeBarang = $this->_kodeBarang($this->input->post('kategoriBarang'));

                    $codeQR = $this->_codeQR($kodeBarang);

                    if ($dataSebelumnya->gambar != null) {
                        unlink(FCPATH . 'uploads/gambar/' . $dataSebelumnya->gambar);
                    }

                    if ($dataSebelumnya->codeQR != null) {
                        unlink(FCPATH . 'uploads/qr/' . $dataSebelumnya->codeQR);
                    }

                    $data = [
                        'kategoriBarang' => $this->input->post('kategoriBarang'),
                        'kodeBarang'     => $kodeBarang,
                        'namaBarang'     => $this->input->post('namaBarang'),
                        'tanggalMasuk'   => $this->input->post('tanggalMasuk'),
                        'stok'           => $this->input->post('stok'),
                        'gambar'          => $upload_data['file_name'],
                        'codeQR'         => $codeQR
                    ];
                } else {
                    if ($dataSebelumnya->gambar != null) {
                        unlink(FCPATH . 'uploads/gambar/' . $dataSebelumnya->gambar);
                    }

                    $data = [
                        'namaBarang'   => $this->input->post('namaBarang'),
                        'tanggalMasuk' => $this->input->post('tanggalMasuk'),
                        'stok'         => $this->input->post('stok'),
                        'gambar'       => $upload_data['file_name']
                    ];
                }
            }
        } else {
            if ($this->input->post('kategoriBarang') != $this->input->post('kategoriBarangSebelumnya')) {
                $kodeBarang = $this->_kodeBarang($this->input->post('kategoriBarang'));

                $codeQR = $this->_codeQR($kodeBarang);

                if ($dataSebelumnya->codeQR != null) {
                    unlink(FCPATH . 'uploads/qr/' . $dataSebelumnya->codeQR);
                }

                $data = [
                    'kategoriBarang' => $this->input->post('kategoriBarang'),
                    'kodeBarang'     => $kodeBarang,
                    'namaBarang'     => $this->input->post('namaBarang'),
                    'tanggalMasuk'   => $this->input->post('tanggalMasuk'),
                    'stok'           => $this->input->post('stok'),
                    'codeQR'         => $codeQR
                ];
            } else {
                $data = [
                    'namaBarang'     => $this->input->post('namaBarang'),
                    'tanggalMasuk'   => $this->input->post('tanggalMasuk'),
                    'stok'           => $this->input->post('stok')
                ];
            }
        }

        $this->db->where('id', $id);
        $update = $this->db->update('barangMasuk', $data);

        if ($update) {
            $this->session->set_flashdata('toastr-success', 'Sukses edit data');
        } else {
            $this->session->set_flashdata('toastr-error', 'Gagal edit data');
        }

        redirect('admin/barang_masuk', 'refresh');
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $dataSebelumnya = $this->db->get('barangMasuk')->row();

        $delete =    $this->db->delete('barangMasuk', ['id' => $id]);

        if ($delete) {
            if ($dataSebelumnya->gambar != null) {
                unlink(FCPATH . 'uploads/gambar/' . $dataSebelumnya->gambar);
            }

            if ($dataSebelumnya->codeQR != null) {
                unlink(FCPATH . 'uploads/qr/' . $dataSebelumnya->codeQR);
            }

            $this->session->set_flashdata('toastr-success', 'Sukses hapus data');
        } else {
            $this->session->set_flashdata('toastr-error', 'Gagal hapus data');
        }

        redirect('admin/barang_masuk', 'refresh');
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

/* End of file Barang_masuk.php */
