<?php

namespace App\Controllers;

use App\Models\ProductsModel;
use App\Models\UsersModel;

class about extends BaseController
{
    protected $productsModel;
    protected $usersModel;

    public function __construct()
    {
        $this->productsModel = new ProductsModel();
        $this->usersModel = new UsersModel();
    }

    public function index()
    {
        $products = $this->productsModel->findAll();

        // jumlah slot twitter_profile_needs
        $tpn = $this->productsModel->where('category', 'twitter_profile_needs')->findAll();
        $jtpn = 0;
        foreach ($tpn as $v) {
            $jtpn += $v['stock'];
        }

        // jumlah slot illustration
        $i = $this->productsModel->where('category', 'illustration')->findAll();
        $ji = 0;
        foreach ($i as $v) {
            $ji += $v['stock'];
        }

        // jumlah slot custom_design
        $cd = $this->productsModel->where('category', 'custom_design')->findAll();
        $jcd = 0;
        foreach ($cd as $v) {
            $jcd += $v['stock'];
        }

        if (isset($_SESSION['user_id'])) {
            $user = $this->usersModel->where('id', $_SESSION['user_id'])->findAll();
            $nama = explode(" ", $user[0]['name']);
            $data = [
                'title' => 'Halaman About',
                'products' => $products,
                'jtpn' => $jtpn,
                'ji' => $ji,
                'jcd' => $jcd,
                'nama' => $nama[0]
            ];
            return view('users/about', $data);        // users
        } else {
            $data = [
                'title' => 'Halaman About',
                'products' => $products,
                'jtpn' => $jtpn,
                'ji' => $ji,
                'jcd' => $jcd,
            ];
            return view('guests/about', $data);        // guests
        }
    }

    //--------------------------------------------------------------------

}