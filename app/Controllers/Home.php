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

		// jumlah slot instagram_feeds
		$if = $this->productsModel->getProduct('instagram_feeds');
		$jif = 0;
		foreach ($if as $v) {
			$jif += $v['stock'];
		}

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

	//--------------------------------------------------------------------

}