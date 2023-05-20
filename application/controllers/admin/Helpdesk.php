<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Helpdesk extends CI_Controller
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
            'title'    => 'Helpdesk',
            'sidebar'  => 'admin/sidebar',
            'page'     => 'admin/helpdesk',
            'helpdesk' => $this->admin->getHelpdesk()
        ];

        $this->load->view('index', $data);
    }

    public function tindakan()
    {
        $data = [
            'tindakan'   => $this->input->post('tindakan'),
            'status'     => $this->input->post('status')
        ];

        $this->db->where('id', $this->input->post('id'));
        $update = $this->db->update('helpdesk', $data);

        if ($update) {
            if ($data['status'] == 'Rusak') {
                $rusak = [
                    'idHelpdesk' => $this->input->post('id')
                ];

                $this->db->insert('barangRusak', $rusak);
            } else {
                $this->db->delete('barangRusak', ['idHelpdesk' => $this->input->post('id')]);
            }

            $this->session->set_flashdata('toastr-success', 'Sukses tambah data');
        } else {
            $this->session->set_flashdata('toastr-error', 'Gagal tambah data');
        }

        redirect('admin/helpdesk', 'refresh');
    }

    public function delete($id)
    {
        $delete =    $this->db->delete('helpdesk', ['id' => $id]);

        if ($delete) {
            $this->db->delete('barangRusak', ['idHelpdesk' => $id]);

            $this->session->set_flashdata('toastr-success', 'Sukses hapus data');
        } else {
            $this->session->set_flashdata('toastr-error', 'Gagal hapus data');
        }

        redirect('admin/helpdesk', 'refresh');
    }
}

/* End of file Barang_masuk.php */
