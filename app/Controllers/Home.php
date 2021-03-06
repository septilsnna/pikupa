<?php

namespace App\Controllers;

use App\Models\ProductsModel;
use App\Models\PromotionsModel;
use App\Models\UsersModel;

class home extends BaseController
{
	protected $productsModel;
	protected $promotionsModel;
	protected $usersModel;

	public function __construct()
	{
		$this->productsModel = new ProductsModel();
		$this->promotionsModel = new PromotionsModel();
		$this->usersModel = new UsersModel();
		$this->session = \Config\Services::session();
	}

	public function index()
	{
		$products = $this->productsModel->getProduct();
		$promotions = $this->promotionsModel->where('status', 'active')->findAll();

		// jumlah slot twitter_profile_needs
		$tpn = $this->productsModel->getProduct('twitter_profile_needs');
		$jtpn = 0;
		foreach ($tpn as $v) {
			$jtpn += $v['stock'];
		}

		// jumlah slot illustration
		$i = $this->productsModel->getProduct('illustration');
		$ji = $i[0]['stock'];

		// jumlah slot custom_design
		$cd = $this->productsModel->getProduct('custom_design');
		$jcd = 0;
		foreach ($cd as $v) {
			$jcd += $v['stock'];
		}

		if (isset($_SESSION['user_id'])) {
			$user = $this->usersModel->getUser($_SESSION['user_id']);
			$nama = explode(" ", $user[0]['name']);
			$data = [
				'title' => 'Halaman Home',
				'products' => $products,
				'promotions' => $promotions,
				'jtpn' => $jtpn,
				'ji' => $ji,
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
				'ji' => $ji,
				'jcd' => $jcd
			];
			return view('guests/home', $data);		// guests
		}
	}

	//--------------------------------------------------------------------

}