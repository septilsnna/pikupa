<?php

namespace App\Controllers;

session_start();

use App\Models\ProductsModel;
use App\Models\PromotionsModel;
use App\Models\PortofoliosModel;
use App\Models\UsersModel;
use App\Models\OrdersModel;
use App\Models\TemplateGIFModel;

class Home extends BaseController
{
	protected $productsModel;
	protected $promotionsModel;
	protected $portofoliosModel;
	protected $usersModel;
	protected $ordersModel;
	protected $templateModel;

	public function __construct()
	{
		$this->productsModel = new ProductsModel();
		$this->promotionsModel = new PromotionsModel();
		$this->portofoliosModel = new PortofoliosModel();
		$this->usersModel = new UsersModel();
		$this->ordersModel = new OrdersModel();
		$this->templateModel = new TemplateGIFModel();
	}

	public function index()
	{
		$products = $this->productsModel->findAll();
		$promotions = $this->promotionsModel->where('status', 'active')->findAll();

		// jumlah slot twitter_profile_needs
		$tpn = $this->productsModel->where('category', 'twitter_profile_needs')->findAll();
		$jtpn = 0;
		foreach ($tpn as $v) {
			$jtpn += $v['stock'];
		}

		// jumlah slot instagram_feeds
		$if = $this->productsModel->where('category', 'instagram_feeds')->findAll();
		$jif = 0;
		foreach ($if as $v) {
			$jif += $v['stock'];
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
				'title' => 'Halaman Home',
				'products' => $products,
				'promotions' => $promotions,
				'jtpn' => $jtpn,
				'jif' => $jif,
				'jcd' => $jcd,
				'nama' => $nama[0]
			];
			return view('users/home', $data);		// users
		} else {
			$data = [
				'title' => 'Halaman Home',
				'products' => $products,
				'promotions' => $promotions,
				'jtpn' => $jtpn,
				'jif' => $jif,
				'jcd' => $jcd
			];
			return view('guests/home', $data);		// guests
		}
	}

	public function register()
	{
		$data = [
			'title' => 'Halaman Daftar'
		];

		if (isset($_SESSION['user_id'])) {
			return redirect()->to('../Home/index');	// users	no
		} else {
			return view('guests/register', $data);	// guests	yes
		}
	}

	public function login()
	{
		$data = [
			'title' => 'Halaman Masuk'
		];

		if (isset($_SESSION['user_id'])) {
			return redirect()->to('../Home/index');	// users	no
		} else {
			return view('guests/login', $data);		// guests	yes
		}
	}

	public function about()
	{
		$products = $this->productsModel->findAll();

		// jumlah slot twitter_profile_needs
		$tpn = $this->productsModel->where('category', 'twitter_profile_needs')->findAll();
		$jtpn = 0;
		foreach ($tpn as $v) {
			$jtpn += $v['stock'];
		}

		// jumlah slot instagram_feeds
		$if = $this->productsModel->where('category', 'instagram_feeds')->findAll();
		$jif = 0;
		foreach ($if as $v) {
			$jif += $v['stock'];
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
				'jif' => $jif,
				'jcd' => $jcd,
				'nama' => $nama[0]
			];
			return view('users/about', $data);		// users
		} else {
			$data = [
				'title' => 'Halaman About',
				'products' => $products,
				'jtpn' => $jtpn,
				'jif' => $jif,
				'jcd' => $jcd,
			];
			return view('guests/about', $data);		// guests
		}
	}

	public function portfolio($param, $id)
	{
		$porto = $this->portofoliosModel->where(array('category' => $param, 'note' => $id))->findAll();
		$style = "background-color: #FEB724; border: 1px solid rgba(0, 0, 0, 0.2); box-sizing: border-box; color:#424242";
		//var_dump($porto);

		if (isset($_SESSION['user_id'])) {
			$user = $this->usersModel->where('id', $_SESSION['user_id'])->findAll();
			$nama = explode(" ", $user[0]['name']);
			$data = [
				'title' => 'Halaman Portfolio',
				'portofolios' => $porto,
				'style' => $style,
				'id' => $id,
				'nama' => $nama[0]
			];
			return view('users/' . $param . '/portofolio_' . $id, $data);		// users
		} else {
			$data = [
				'title' => 'Halaman Portfolio',
				'portofolios' => $porto,
				'style' => $style,
				'id' => $id
			];
			return view('guests/' . $param . '/portofolio_' . $id, $data);		// guests
		}
	}

	public function order($category, $sub_category = null, $product_id = null)			// twitter_profile_needs/template_gif/id_product
	{
		$_SESSION['category'] = $category;
		$_SESSION['sub_category'] = $sub_category;

		// show categories
		$categories = $this->productsModel->where('category', $category)->findAll();
		// template for twitter profile needs
		$template = $this->templateModel->findAll();
		// category and sub-category name
		$products = $this->productsModel->where(array('category' => $category, 'sub_category' => $sub_category))->findAll();

		//$total = $categories[0]['price'] - ($categories[0]['price'] * $categories[0]['discount'] / 100);
		//var_dump($total);

		$data = [
			'title' => 'Order ' . $categories[0]['category_name'],
			'template' => $template
		];

		if (isset($_SESSION['user_id'])) {							// user
			$user = $this->usersModel->where('id', $_SESSION['user_id'])->findAll();
			$nama = explode(" ", $user[0]['name']);
			$data = [
				'title' => 'Order ' . $categories[0]['category_name'],
				'user' => $user,
				'nama' => $nama[0],
				'categories' => $categories,
				'template' => $template,
				'product' => $products,
			];
			if ($sub_category != null) {										// user udah pilih kategori -> pilih produk
				if ($product_id != null) {									// user udah pilih kategori dan produk -> form
					$prods = null;
					if ($sub_category == 'template_gif') {
						$prods = $this->templateModel->where('id', $product_id)->findAll();
					} else {
						$prods = $this->productsModel->where('sub_category', $sub_category)->findAll();
					}
					$total = $prods[0]['price'] - ($prods[0]['price'] * $products[0]['discount'] / 100);
					//var_dump($total);
					$data['id'] = $prods;
					$data['total'] = $total;
					$_SESSION['product_id'] = $product_id;
					return view('users/' . $category . '/form', $data);
				} else {											// user udah pilih kategori dan belum milih produk -> pilih produk
					return view('users/' . $category . '/' . $sub_category, $data);
				}
			} else {												// user belum pilih kategori -> pilih kategori
				return view('users/' . $category . '/order', $data);
			}
		} else {													// guest
			$data = [
				'title' => 'Order ' . $categories[0]['category_name'],
				'categories' => $categories,
				'template' => $template,
			];
			if ($sub_category != null) {										// guest udah pilih kategori -> login
				return redirect()->to('../Home/login');
			} else {												// guest belum pilih kategori -> pilih kategori
				return view('guests/' . $category . '/order', $data);
			}
		}
	}

	public function order_sucess()
	{
		$user = $this->usersModel->where('id', $_SESSION['user_id'])->findAll();
		$nama = explode(" ", $user[0]['name']);

		$data = [
			'nama' => $nama[0],
		];

		return view('users/berhasil_order', $data);
	}

	public function profile()
	{
		$order = $this->ordersModel->where('user_id', $_SESSION['user_id'])->findAll();

		$user = $this->usersModel->where('id', $_SESSION['user_id'])->findAll();
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
		$user = $this->usersModel->where('id', $_SESSION['user_id'])->findAll();
		$nama = explode(" ", $user[0]['name']);

		$data = [
			'user' => $user,
			'nama' => $nama[0],
		];

		return view('users/kelola_akun', $data);
	}

	public function connection()
	{
		$user = $this->usersModel->where('id', $_SESSION['user_id'])->findAll();
		$nama = explode(" ", $user[0]['name']);

		$data = [
			'user' => $user,
			'nama' => $nama[0],
		];

		return view('users/akun_tertaut', $data);
	}

	//--------------------------------------------------------------------

}