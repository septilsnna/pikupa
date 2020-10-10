<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\OrdersModel;

class profile extends BaseController
{
    protected $usersModel;
    protected $ordersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->ordersModel = new OrdersModel();
        $this->email = \Config\Services::email();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $order = $this->ordersModel->getOrder($_SESSION['user_id']);

        $this->usersModel
            ->where('id', $_SESSION['user_id'])
            ->set(['order_freq' => count($order)])
            ->update();

        $user = $this->usersModel->getUser($_SESSION['user_id']);
        $nama = explode(" ", $user[0]['name']);

        $bulan = [1 => 'Januari', 'Februari', 'Maret', 'Aptil', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $tgl = explode('-', $user[0]['created_at']);

        $create = (int)$tgl[2] . ' ' . $bulan[(int)$tgl[1]] . ' ' . $tgl[0];

        $data = [
            'user' => $user,
            'order' => $order,
            'nama' => $nama[0],
            'gabung' => $create
        ];

        return view('users/profile', $data);
    }

    public function edit_profile()
    {
        $user = $this->usersModel->getUser($_SESSION['user_id']);
        $nama = explode(" ", $user[0]['name']);

        $data = [
            'user' => $user[0],
            'nama' => $nama[0],
        ];

        $data['validation'] = \Config\Services::validation();
        return view('users/kelola_akun', $data);
    }

    public function connection()
    {
        $user = $this->usersModel->getUser($_SESSION['user_id']);
        $nama = explode(" ", $user[0]['name']);

        $data = [
            'user' => $user,
            'nama' => $nama[0],
        ];

        return view('users/akun_tertaut', $data);
    }

    public function name_update()
    {
        // validasi input
        if (!$this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi',
                ]
            ],
        ])) {

            return redirect()->to('/profile/edit_profile')->withInput();
        }

        // dapatkan input user
        $name = $this->request->getVar('name');

        // update nama user
        $this->usersModel->where('id', $_SESSION['user_id'])->set(['name' => $name])->update();

        $_SESSION['update'] = 'Nama berhasil diperbarui!';
        $this->session->markAsTempdata('update', 10);

        return redirect()->to('/profile/index');
    }
    public function password_update()
    {
        // validasi input
        if (!$this->validate([
            'password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Password harus diisi',
                    'min_length' => 'Password minimal terdiri dari 8 karakter'
                ]
            ],
            'password2' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Password konfirmasi harus diisi',
                    'matches' => 'Password konfirmasi tidak sesuai'
                ]
            ],
        ])) {

            return redirect()->to('/profile/edit_profile')->withInput();
        }

        // dapatkan input user
        $password = $this->request->getVar('password');

        // enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // update password user
        $this->usersModel->where('id', $_SESSION['user_id'])->set(['password' => $password])->update();

        $_SESSION['update'] = 'Password berhasil diperbarui!';
        $this->session->markAsTempdata('update', 10);

        return redirect()->to('/profile/index');
    }

    public function email_update()
    {
        // validasi input
        if (!$this->validate([
            'email' => [
                'rules' => 'required|is_unique[users.email]|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'is_unique' => 'Email sudah terdaftar',
                    'valid_email' => 'Email tidak valid'
                ]
            ],
        ])) {

            return redirect()->to('/profile/edit_profile')->withInput();
        }

        // dapatkan input user
        $email = $this->request->getVar('email');

        // update email user dan status verified nya
        $this->usersModel->where('id', $_SESSION['user_id'])->set(['email' => $email, 'verified' => 0])->update();

        $user = $this->usersModel->where('email', $email)->findAll();

        $this->email->setFrom('pikuupa@gmail.com', 'Pikupa.id');
        $this->email->setTo($email);
        $this->email->setSubject('Permintaan Pengubahan Alamat Email');
        $this->email->setMessage('<div style="font-family: Montserrat; text-align: center; padding-top: 50px; padding-bottom: 50px; font-size: 18px; color: #424242;">
        <h3>Verifikasi Email Kamu Sekarang!</h3>
        <p>Hai Kak ' . $user[0]['name'] . ',</p>
        <p>
          Kakak telah mendaftarkan email ' . $email . ' sebagai alamat email kakak
          di Pikupa.id
        </p>
        <p>
          Silahkan klik link berikut ini untuk melakukan verifikasi akun Kakak
          agar bisa segera masuk ke website kami.
        </p>
          <a style="
              background-color: #ffce67;
              color: #424242;
              border-radius: 15px;
              border: none;
              padding: 15px 32px;
              text-decoration: none;
              display: inline-block;
              margin: 4px 2px;
              cursor: pointer;
            "
            href="' . base_url() . '/verification/token/' . $user[0]['token'] . '">
            Aktivasi Akun Saya
          </a>
        </p>
        <h4>Piku tunggu pesanan kakak di Pikupa.id!</h4>
      </div>');
        $this->email->send();

        $_SESSION['update'] = 'Email berhasil diperbarui! Segera verifikasikan email kamu melalui link yang telah Piku kirim ke ' .
            $email . ' ya :)';
        $this->session->markAsTempdata('update', 20);

        return redirect()->to('/profile/index');
    }

    //--------------------------------------------------------------------

}