<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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

        if ($this->dt_user->role_id == 2) {
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function index()
    {
        $data = [
            'title'      => 'User Admin',
            'sidebar'    => 'admin/sidebar',
            'page'       => 'admin/user',
            'user'       => $this->admin->getUser(),
            'distribusi' => $this->admin->getDistribusi()
        ];

        $this->load->view('index', $data);
    }

    public function add()
    {
        $data = [
            'name'         => $this->input->post('name'),
            'username'     => $this->input->post('username'),
            'image'        => 'default.png',
            'password'     => password_hash('user123', PASSWORD_BCRYPT),
            'role_id'      => $this->input->post('role_id'),
            'idDistribusi' => $this->input->post('distribusi')
        ];

        $insert = $this->db->insert('user', $data);

        if ($insert) {
            $this->session->set_flashdata('toastr-success', 'Sukses tambah admin');
        } else {
            $this->session->set_flashdata('toastr-error', 'Gagal tambah admin');
        }

        redirect('admin/user', 'refresh');
    }

    public function edit()
    {
        $data = [
            'name'         => $this->input->post('name'),
            'username'     => $this->input->post('username'),
            'image'        => 'default.png',
            'password'     => password_hash('user123', PASSWORD_BCRYPT),
            'role_id'      => $this->input->post('role_id'),
            'idDistribusi' => $this->input->post('distribusi')
        ];

        $this->db->where('id', $this->input->post('id'));
        $update = $this->db->update('user', $data);

        if ($update) {
            $this->session->set_flashdata('toastr-success', 'Sukses tambah admin');
        } else {
            $this->session->set_flashdata('toastr-error', 'Gagal tambah admin');
        }

        redirect('admin/user', 'refresh');
    }

    public function delete($id)
    {
        $this->db->delete('user', ['id' => $id]);
        redirect('admin/user', 'refresh');
    }

    public function resetPwd($id)
    {
        $data = [
            'password' => password_hash('user123', PASSWORD_BCRYPT)
        ];

        $this->db->where('id', $id);
        $reset = $this->db->update('user', $data);

        if ($reset) {
            $this->session->set_flashdata('toastr-success', 'Sukses reset password');
        } else {
            $this->session->set_flashdata('toastr-error', 'Gagal reset password');
        }

        redirect('admin/user', 'refresh');
    }
}

  /* End of file User_admin.php */
