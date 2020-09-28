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
    }

    public function register()
    {
        // validasi input
        if (!$this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi.'
                ]
            ],
            'id' => [
                'rules' => 'required|is_unique[users.id]',
                'errors' => [
                    'required' => 'Username harus diisi.',
                    'is_unique' => 'Username sudah terdaftar'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Pssword harus diisi.',
                    'min_length' => 'Password minimal terdiri dari 8 karakter'
                ]
            ],
        ])) {
            $validation = \Config\Services::validation();
            $data['validation'] = $validation;
            return redirect()->to('')->withInput()->with('validation', $validation);
        }

        // dapatkan input user
        $name = htmlspecialchars($this->request->getVar('name'));
        $id = htmlspecialchars($this->request->getVar('id'));
        $email = htmlspecialchars($this->request->getVar('email'));
        $password = $this->request->getVar('password');
        $password2 = $this->request->getVar('password2');

        // cek email
        if ($this->usersModel->where('email', $email)->findAll() != null) {
            echo "<script>
            alert('Email sudah terdaftar!');
            </script>";
            return false;
        }

        // cek username
        if ($this->usersModel->where('id', $id)->findAll() != null) {
            echo "<script>
            alert('username sudah terdaftar!');
            </script>";
            return false;
        }

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

        $newuser = [
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'password' => $password
        ];
        $this->usersModel->insert($newuser);

        return redirect()->to('../Home/login');
    }

    public function login()
    {
        // dapatkan username and password dari input
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $this->usersModel->where('email', $email)->findAll();
        $password_hash = $user[0]['password'];

        if ($user != null) {
            if (password_verify($password, $password_hash)) {
                if ($email == 'akuadmin@iya.com') {
                    return redirect()->to('/Admin/dashboard');
                } else {
                    $_SESSION['user_id'] = $user[0]['id'];
                    return redirect()->to('/Home/index');
                }
            } else {
                echo "<script>
                    alert('Password tidak sesuai!');
                </script>";
                return redirect()->to('../Home/login');
            }
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        return redirect()->to('../Home/index');
    }

    public function ordering($category, $sub_category, $product_id)
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
            // 'id_card' => [
            //     'rules' => 'uploaded[id_card]|max_size[id_card,1024]|is_image[id_card]|mime_in[id_card,image/jpg,image/jpeg,image/png]',
            //     'errors' => [
            //         'uploaded' => 'Pilih gambar bukti pembayaran.',
            //         'max_size' => 'Ukuran gambar terlalu besar.',
            //         'is_image' => 'Upss, yang kamu pilih bukan gambar.',
            //         'mime_in' => 'Upss, yang kamu pilih bukan gambar.'
            //     ]
            // ],
        ])) {
            // $validation = \Config\Services::validation();
            // $data['validation'] = $validation;
            // return redirect()->to('../Home/order/' . $category . '/' . $sub_category . '/' . $product_id)->withInput()->with('validation', $validation);
            return redirect()->to('../Home/order/' . $category . '/' . $sub_category . '/' . $product_id)->withInput();
        }

        $file = $this->request->getFile('invoice');     // ambil file bukti bayar
        $judul = $file->getRandomName();                // generate nama random
        $file->move('invoices', $judul);                 // pindahkan ke folder invoice

        // $file2 = $this->request->getFile('id_card');     // ambil file idcard
        // $idcard = $file2->getRandomName();                // generate nama random
        // $file2->move('idcard', $idcard);                 // pindahkan ke folder idcard

        $product = $this->productsModel->where(array('category' => $category, 'sub_category' => $sub_category))->findAll();

        // update stok yang tersedia
        $this->productsModel
            ->where('sub_category', $sub_category)
            ->set(['stock' => $product[0]['stock'] - 1])
            ->update();

        $total = $product[0]['price'] - ($product[0]['price'] * $product[0]['discount'] / 100);

        $order = count($this->ordersModel->findAll());

        $user = $this->usersModel->where('id', $_SESSION['user_id'])->findAll();

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
            //'id_card' => $idcard,
            'status' => 'On Review',
            'total_payment' => $total,
        ];

        $this->ordersModel->insert($data);

        return redirect()->to('../Home/order_sucess');
    }

    public function order_custom_gif()
    {
        $ud  = $_POST['size11'] . $_POST['size21'] . $_POST['size31'];
        //var_dump($_SESSION['category']);
        //var_dump($ud);        // ukuran custom gif
        return redirect()->to('../Home/order/twitter_profile_needs/custom_gif/' . $ud);
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

        return redirect()->to('../Home/profile');
    }

    public function email_update()
    {
        // dapatkan input user
        $email = $this->request->getVar('email');

        // update email user
        $this->usersModel->where('id', $_SESSION['user_id'])->set(['email' => $email])->update();

        return redirect()->to('../Home/profile');
    }

    //--------------------------------------------------------------------

}