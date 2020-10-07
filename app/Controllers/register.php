<?php

namespace App\Controllers;

use App\Models\UsersModel;

class register extends BaseController
{
    protected $usersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->email = \Config\Services::email();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        if (isset($_SESSION['user_id'])) {
            return redirect()->to('../home/index');    // users	no
        } else {
            $data['validation'] = \Config\Services::validation();
            return view('guests/register', $data);    // guests	yes
        }
    }

    public function config()
    {
        // validasi input
        if (!$this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi'
                ]
            ],
            'id' => [
                'rules' => 'required|is_unique[users.id]',
                'errors' => [
                    'required' => 'Username harus diisi',
                    'is_unique' => 'Username sudah terdaftar'
                ]
            ],
            'email' => [
                'rules' => 'required|is_unique[users.email]|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'is_unique' => 'Email sudah terdaftar',
                    'valid_email' => 'Email tidak valid'
                ]
            ],
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

            return redirect()->to('/register')->withInput();
        }

        // enkripsi password
        $password = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
        $token = substr(sha1(time()), 0, 100);

        $nama = htmlspecialchars($this->request->getVar('name'));
        $email = htmlspecialchars($this->request->getVar('email'));

        $newuser = [
            'id' => htmlspecialchars($this->request->getVar('id')),
            'name' => $nama,
            'email' => $email,
            'token' => $token,
            'password' => $password
        ];

        $this->usersModel->insert($newuser);

        $this->email->setFrom('pikuupa@gmail.com', 'Pikupa.id');
        $this->email->setTo($email);
        $this->email->setSubject('Verifikasi Alamat Email Kamu di Pikupa.id');
        $this->email->setMessage('<div style="font-family: Montserrat; text-align: center; padding-top: 50px; padding-bottom: 50px; font-size: 18px; color: #424242;">
        <h3>Verifikasi Email Kamu Sekarang!</h3>
        <p>Hai Kak ' . $nama . ',</p>
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
            href="' . base_url() . '/verification/token/' . $token . '">
            Aktivasi Akun Saya
          </a>
        </p>
        <h4>Piku tunggu pesanan kakak di Pikupa.id!</h4>
      </div>');
        $this->email->send();

        $_SESSION['message'] = 'Kami baru saja mengirimkan email untuk memverifikasikan akun sebelum mulai order.';
        $this->session->markAsTempdata('message', 20);

        return redirect()->to('/register');
    }

    public function SignUpWithTwitter($callbackURL)
    {
        echo "CallbackURL";
    }

    //--------------------------------------------------------------------

}