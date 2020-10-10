<?php

namespace App\Controllers;

date_default_timezone_set("Asia/Bangkok");

use App\Models\UsersModel;
use App\Models\OrdersModel;
use App\Models\ProductsModel;

class Config extends BaseController
{
    protected $usersModel;
    protected $ordersModel;
    protected $productsModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->ordersModel = new OrdersModel();
        $this->productsModel = new ProductsModel();
        $this->email = \Config\Services::email();
        $this->session = \Config\Services::session();
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        return redirect()->to('/home/index');
    }

    public function order_custom_gif()
    {
        $ud  = $_POST['size11'] . $_POST['size21'] . $_POST['size31'];
        return redirect()->to('/order/index/twitter_profile_needs/custom_gif/' . $ud);
    }

    public function order_full_color()
    {
        $ud  = $_POST['fcHead'] . $_POST['fcHalfBody'] . $_POST['fcFullBody'];
        return redirect()->to('/order/index/illustration/full_color/' . $ud);
    }

    public function order_outline()
    {
        $ud  = $_POST['oHead'] . $_POST['oHalfBody'] . $_POST['oFullBody'];
        return redirect()->to('/order/index/illustration/outline/' . $ud);
    }

    public function forget_pass()
    {
        $token = substr(sha1(time()), 0, 100);
        $email = $this->request->getVar('email');

        // update token, verivied, password
        $this->usersModel
            ->where('email', $email)
            ->set(['token' => $token, 'verified' => 0, 'password' => ''])
            ->update();

        $user = $this->usersModel->where('email', $email)->findAll();

        $this->email->setFrom('pikuupa@gmail.com', 'Pikupa.id');
        $this->email->setTo($email);
        $this->email->setSubject('Permintaan Pengubahan Kata Sandi');
        $this->email->setMessage('<div style="font-family: Montserrat; text-align: center; padding-top: 50px; padding-bottom: 50px; font-size: 18px; color: #424242;">
        <h3>Ubah Kata Sandi Kamu Sekarang!</h3>
        <p>Hai Kak ' . $user[0]['name'] . ',</p>
        <p>
          Kakak telah mengajukan pengubahan password melalui alamat email ' . $email . ' sebagai alamat email kakak
          di Pikupa.id
        </p>
        <p>
          Silahkan klik link berikut ini untuk melakukan perubahan password akun Kakak
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
            href="' . base_url() . '/verification/forget_pass/' . $token . '">
            Perbarui Password Saya
          </a>
        </p>
        <h4>Piku tunggu pesanan kakak di Pikupa.id!</h4>
      </div>');
        $this->email->send();

        $this->session->set('forget', 'Link verifikasi update password berhasil dikirimkan ke ' .
            $email . ', segera lakukan verifikasi ya Kak :)');
        $this->session->markAsTempdata('forget', 20);

        return redirect()->to('/login');
    }

    public function update_pass($token)
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

            return redirect()->to('/forget/index/' . $token)->withInput();
        }

        // dapatkan input user
        $password = $this->request->getVar('password');

        // enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // update password user
        $this->usersModel->where('token', $token)->set(['password' => $password, 'verified' => 1])->update();

        $this->session->set('update', 'Password berhasil diperbarui!');
        $this->session->markAsTempdata('update', 10);

        return redirect()->to('/login');
    }

    //--------------------------------------------------------------------

}