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

    public function register()
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
        $this->email->setMessage('<h3 class="my-3">Verifikasi Email Kamu Sekarang!</h3>
        <h4>
          Selamat ya! Data registrasi kamu telah berhasil kami simpan.
          <br />Verifikasi email kamu dengan klik
          <a href="' . base_url() . '/verification/token/' . $token . '">Link Verifikasi</a><br />
          agar akun kamu lebih aman.
        </h4>
        <h3>Piku tunggu pesanan kamu di Pikupa.id!</h3>');
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

    public function login()
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
                        return redirect()->to('/home');
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

    public function logout()
    {
        session_unset();
        session_destroy();
        return redirect()->to('/home');
    }

    public function ordering_cd($sub_category, $product_id)
    {
        // validasi input
        if (!$this->validate([
            'id_card' => [
                'rules' => 'uploaded[id_card]|max_size[id_card,1024]|is_image[id_card]|mime_in[id_card,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar bukti pembayaran.',
                    'max_size' => 'Ukuran gambar terlalu besar.',
                    'is_image' => 'Upss, yang kamu pilih bukan gambar.',
                    'mime_in' => 'Upss, yang kamu pilih bukan gambar.'
                ]
            ],
            'contactin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kontak harus diisi.'
                ]
            ],
            'invoice' => [
                'rules' => 'uploaded[invoice]|max_size[invoice,1024]|is_image[invoice]|mime_in[invoice,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar bukti pembayaran.',
                    'max_size' => 'Ukuran gambar terlalu besar.',
                    'is_image' => 'Upss, yang kamu pilih bukan gambar.',
                    'mime_in' => 'Upss, yang kamu pilih bukan gambar.'
                ]
            ],
        ])) {
            return redirect()->to('/order/index/custom_design/' . $sub_category . '/' . $product_id)->withInput();
        }

        $file = $this->request->getFile('invoice');     // ambil file bukti bayar
        $judul = $file->getRandomName();                // generate nama random
        $file->move('invoices', $judul);                 // pindahkan ke folder invoice

        $file2 = $this->request->getFile('id_card');     // ambil file idcard
        $idcard = $file2->getRandomName();                // generate nama random
        $file2->move('idcard', $idcard);                 // pindahkan ke folder idcard

        $product = $this->productsModel->getSubProduct('custom_design', $sub_category);

        // update stok yang tersedia
        $this->productsModel
            ->where('sub_category', $sub_category)
            ->set(['stock' => $product[0]['stock'] - 1])
            ->update();

        $total = $product[0]['price'] - ($product[0]['price'] * $product[0]['discount'] / 100);

        $order = count($this->ordersModel->getOrder());

        $user = $this->usersModel->getUser($_SESSION['user_id']);

        $data = [
            'id' => 'PKPA00' . $order,
            'user_id' => $_SESSION['user_id'],
            'nama_user' => $user[0]['name'],
            'email_user' => $user[0]['email'],
            'product_id' => $product[0]['id'],
            'product_name' => $product[0]['sub_category_name'],
            'note' => $product_id,
            'contact_method' => $this->request->getVar('contact'),
            'contact' => $this->request->getVar('contactin'),
            'payment_method' => $this->request->getVar('payment_method'),
            'proof_of_payment' => $judul,
            'id_card' => $idcard,
            'deadline' => $this->request->getVar('deadline'),
            'status' => 'On Review',
            'total_payment' => $total,
        ];

        $this->ordersModel->insert($data);

        return redirect()->to('/order/order_sucess');
    }

    public function ordering_tpn($sub_category, $product_id)
    {
        // validasi input
        if (!$this->validate([
            'contactin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kontak harus diisi.'
                ]
            ],
            'invoice' => [
                'rules' => 'uploaded[invoice]|max_size[invoice,1024]|is_image[invoice]|mime_in[invoice,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar bukti pembayaran.',
                    'max_size' => 'Ukuran gambar terlalu besar.',
                    'is_image' => 'Upss, yang kamu pilih bukan gambar.',
                    'mime_in' => 'Upss, yang kamu pilih bukan gambar.'
                ]
            ],
        ])) {
            return redirect()->to('/order/index/twitter_profile_needs/' . $sub_category . '/' . $product_id)->withInput();
        }

        $file = $this->request->getFile('invoice');     // ambil file bukti bayar
        $judul = $file->getRandomName();                // generate nama random
        $file->move('invoices', $judul);                 // pindahkan ke folder invoice

        $product = $this->productsModel->getSubProduct('twitter_profile_needs', $sub_category);

        // update stok yang tersedia
        $this->productsModel
            ->where('sub_category', $sub_category)
            ->set(['stock' => $product[0]['stock'] - 1])
            ->update();

        $total = $product[0]['price'] - ($product[0]['price'] * $product[0]['discount'] / 100);

        $order = count($this->ordersModel->getOrder());

        $user = $this->usersModel->getUser($_SESSION['user_id']);

        $data = [
            'id' => 'PKPA00' . $order,
            'user_id' => $_SESSION['user_id'],
            'nama_user' => $user[0]['name'],
            'email_user' => $user[0]['email'],
            'product_id' => $product[0]['id'],
            'product_name' => $product[0]['sub_category_name'],
            'note' => $product_id,
            'contact_method' => $this->request->getVar('contact'),
            'contact' => $this->request->getVar('contactin'),
            'payment_method' => $this->request->getVar('payment_method'),
            'proof_of_payment' => $judul,
            'status' => 'On Review',
            'total_payment' => $total,
        ];

        $this->ordersModel->insert($data);

        return redirect()->to('/order/order_sucess');
    }

    public function order_custom_gif()
    {
        $ud  = $_POST['size11'] . $_POST['size21'] . $_POST['size31'];
        //var_dump($_SESSION['category']);
        //var_dump($ud);        // ukuran custom gif
        return redirect()->to('/order/index/twitter_profile_needs/custom_gif/' . $ud);
    }

    public function password_update()
    {
        // dapatkan input user
        $password = $this->request->getVar('password');
        $password2 = $this->request->getVar('password2');

        // password minimal 8 karakter
        if (strlen($password) <= 8) {
            echo "<script>
                    alert('Password harus lebih dari 8 karakter!');
                    </script>";
            return false;
        }

        // cek password confirm
        if ($password != $password2) {
            echo "<script>
            alert('Password konfirmasi tidak sesuai!');
            </script>";
            return false;
        }

        // enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // update password user
        $this->usersModel->where('id', $_SESSION['user_id'])->set(['password' => $password])->update();

        return redirect()->to('/profile');
    }

    public function email_update()
    {
        // dapatkan input user
        $email = $this->request->getVar('email');

        // update email user
        $this->usersModel->where('id', $_SESSION['user_id'])->set(['email' => $email])->update();

        return redirect()->to('/profile');
    }

    //--------------------------------------------------------------------

}