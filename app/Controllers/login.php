<?php

namespace App\Controllers;

use App\Models\UsersModel;

class login extends BaseController
{
    protected $usersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $data = [
            'title' => 'Halaman Masuk'
        ];

        if (isset($_SESSION['user_id'])) {
            return redirect()->to('../home/index');           // users	no
        } else {
            return view('guests/login', $data);        // guests	yes
        }
    }

    public function config()
    {
        // dapatkan username and password dari input
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $this->usersModel->where('email', $email)->findAll();

        if ($user != null) {
            $password_hash = $user[0]['password'];
            if (password_verify($password, $password_hash)) {
                if ($email == 'akuadmin@iya.com') {
                    return redirect()->to('/Admin/dashboard');
                } else {
                    if ($user[0]['verified'] == 1) {
                        $_SESSION['user_id'] = $user[0]['id'];
                        return redirect()->to('/home/index');
                    } else {
                        $_SESSION['verified'] = 'Email belum terverifikasi, silahkan verifikasi email kamu.';
                        $this->session->markAsTempdata('verified', 10);

                        return redirect()->to('/login')->withInput();
                    }
                }
            } else {
                $_SESSION['wrong_password'] = 'Password tidak sesuai, cek kembali password kamu.';
                $this->session->markAsTempdata('wrong_password', 10);

                return redirect()->to('/login')->withInput();
            }
        } else {
            $_SESSION['not_found'] = 'Email belum terdaftar, cek kembali email kamu.';
            $this->session->markAsTempdata('not_found', 10);

            return redirect()->to('/login')->withInput();
        }
    }

    //--------------------------------------------------------------------

}