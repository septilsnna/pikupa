<?php

namespace App\Controllers;

date_default_timezone_set("Asia/Bangkok");

use App\Models\ProductsModel;
use App\Models\UsersModel;
use App\Models\TemplateGIFModel;
use App\Models\OrdersModel;

class order extends BaseController
{
    protected $productsModel;
    protected $usersModel;
    protected $templateModel;
    protected $ordersModel;

    public function __construct()
    {
        $this->productsModel = new ProductsModel();
        $this->usersModel = new UsersModel();
        $this->templateModel = new TemplateGIFModel();
        $this->ordersModel = new OrdersModel();
        $this->session = \Config\Services::session();
    }

    public function index($category, $sub_category = null, $product_id = null)            // twitter_profile_needs/template_gif/id_product
    {
        $_SESSION['category'] = $category;
        $_SESSION['sub_category'] = $sub_category;

        // show categories
        $categories = $this->productsModel->getProduct($category);
        // template for twitter profile needs
        $template = $this->templateModel->findAll();
        // category and sub-category name
        $products = $this->productsModel->getSubProduct($category, $sub_category);

        //$total = $categories[0]['price'] - ($categories[0]['price'] * $categories[0]['discount'] / 100);
        //var_dump($total);

        $data = [
            'title' => 'Order ' . $categories[0]['category_name'],
            'template' => $template
        ];

        if (isset($_SESSION['user_id'])) {                            // user
            $user = $this->usersModel->getUser($_SESSION['user_id']);
            $nama = explode(" ", $user[0]['name']);
            $data = [
                'title' => 'Order ' . $categories[0]['category_name'],
                'user' => $user,
                'nama' => $nama[0],
                'categories' => $categories,
                'template' => $template,
                'product' => $products,
            ];
            if ($sub_category != null) {                                        // user udah pilih kategori -> pilih produk
                if ($product_id != null) {                                    // user udah pilih kategori dan produk -> form
                    $prods = null;
                    if ($sub_category == 'template_gif') {
                        $prods = $this->templateModel->getTemplate($product_id);
                    } else {
                        $prods = $this->productsModel->getSubProduct($category, $sub_category);
                    }

                    $price = $prods[0]['price'];
                    // Harga Ilustrasi beda dari start-from
                    if ($category == 'illustration') {
                        if ($product_id == 'half_body') {
                            $price += 25000;
                        } else if ($product_id == 'full_body') {
                            $price += 50000;
                        }
                    } // Harga Ilustrasi beda dari start-from

                    $total = $price - ($price * $products[0]['discount'] / 100);
                    //var_dump($total);
                    $data['id'] = $prods;
                    $data['price'] = $price;
                    $data['total'] = $total;
                    $data['validation'] = \Config\Services::validation();
                    $_SESSION['product_id'] = $product_id;

                    if ($user[0]['verified'] == 0) {                             // user ganti email belom verif
                        $_SESSION['failed'] = 'Email baru kamu belum terverifikasi, silahkan verifikasi email kamu terlebih dahulu untuk melakukan pemesanan.';
                        $this->session->markAsTempdata('failed', 10);
                        return view('users/' . $category . '/order', $data);
                    } else {
                        return view('users/' . $category . '/form', $data);
                    }
                } else {                                            // user udah pilih kategori dan belum milih produk -> pilih produk
                    return view('users/' . $category . '/' . $sub_category, $data);
                }
            } else {                                                // user belum pilih kategori -> pilih kategori
                return view('users/' . $category . '/order', $data);
            }
        } else {                                                    // guest
            $data = [
                'title' => 'Order ' . $categories[0]['category_name'],
                'categories' => $categories,
                'template' => $template,
            ];
            if ($sub_category != null) {                                        // guest udah pilih kategori -> login
                return redirect()->to('../login');
            } else {                                                // guest belum pilih kategori -> pilih kategori
                return view('guests/' . $category . '/order', $data);
            }
        }
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

        $order = count($this->ordersModel->getOrder()) + 1;

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

        return redirect()->to('/order/order_sucess/' . 'PKPA00' . $order);
    }

    public function ordering_il($sub_category, $product_id)
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
            return redirect()->to('/order/index/illustration/' . $sub_category . '/' . $product_id)->withInput();
        }

        $file = $this->request->getFile('invoice');     // ambil file bukti bayar
        $judul = $file->getRandomName();                // generate nama random
        $file->move('invoices', $judul);                 // pindahkan ke folder invoice

        $product = $this->productsModel->getSubProduct('illustration', $sub_category);

        // update stok yang tersedia
        $this->productsModel
            ->where('sub_category', $sub_category)
            ->set(['stock' => $product[0]['stock'] - 1])
            ->update();

        $price = $product[0]['price'];
        if ($product_id == 'half_body') {
            $price += 25000;
        } else if ($product_id == 'full_body') {
            $price += 50000;
        }

        $total = $price - ($price * $product[0]['discount'] / 100);

        $order = count($this->ordersModel->getOrder()) + 1;

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

        return redirect()->to('/order/order_sucess/' . 'PKPA00' . $order);
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

        $order = count($this->ordersModel->getOrder()) + 1;

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

        return redirect()->to('/order/order_sucess/' . 'PKPA00' . $order);
    }

    public function order_sucess()
    {
        $user = $this->usersModel->getUser($_SESSION['user_id']);
        $nama = explode(" ", $user[0]['name']);

        $data = [
            'nama' => $nama[0],
        ];

        return view('users/berhasil_order', $data);
    }

    //--------------------------------------------------------------------

}