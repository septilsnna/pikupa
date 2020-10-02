<?php

namespace App\Controllers;

use App\Models\ProductsModel;
use App\Models\UsersModel;
use App\Models\TemplateGIFModel;

class order extends BaseController
{
    protected $productsModel;
    protected $usersModel;
    protected $templateModel;

    public function __construct()
    {
        $this->productsModel = new ProductsModel();
        $this->usersModel = new UsersModel();
        $this->templateModel = new TemplateGIFModel();
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
                    $total = $prods[0]['price'] - ($prods[0]['price'] * $products[0]['discount'] / 100);
                    //var_dump($total);
                    $data['id'] = $prods;
                    $data['total'] = $total;
                    $data['validation'] = \Config\Services::validation();
                    $_SESSION['product_id'] = $product_id;
                    return view('users/' . $category . '/form', $data);
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