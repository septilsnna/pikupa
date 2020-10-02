<?php

namespace App\Controllers;

use App\Models\OrdersModel;
use App\Models\ProductsModel;
use App\Models\PortofoliosModel;
use App\Models\PromotionsModel;
use App\Models\UsersModel;

class Admin extends BaseController
{
    protected $orderProgressModel;
    protected $ordersModel;
    protected $productsModel;
    protected $portofoliosModel;
    protected $promotionsModel;
    protected $usersModel;

    public function __construct()
    {
        $this->ordersModel = new OrdersModel();
        $this->productsModel = new ProductsModel();
        $this->portofoliosModel = new PortofoliosModel();
        $this->promotionsModel = new PromotionsModel();
        $this->usersModel = new UsersModel();
    }

    public function dashboard()
    {
        $data = [];
        $data['review'] = count($this->ordersModel->where('status', 'On Review')->findAll());
        $data['process'] = count($this->ordersModel->where('status', 'Process')->findAll());
        $data['finish'] = count($this->ordersModel->where('status', 'Finish')->findAll());
        $data['reject'] = count($this->ordersModel->where('status', 'Rejected')->findAll());

        $data['pendapatan'] = 0;
        $total = $this->ordersModel->where('status', 'Finish')->findAll();
        foreach ($total as $t) {
            $data['pendapatan'] += (int)$t['total_payment'];
        }

        $data['promosi'] = 0;
        $total = $this->promotionsModel->findAll();
        foreach ($total as $t) {
            $data['promosi'] += (int)$t['price'];
        }
        $data['p_promosi'] = count($total);

        $data['user'] = count($this->usersModel->findAll());

        return view('admin/dashboard', $data);
    }

    public function orders()
    {
        $data = [];
        $data['all_orders'] = $this->ordersModel->findAll();
        $data['review'] = $this->ordersModel->where('status', 'On Review')->findAll();
        $data['process'] = $this->ordersModel->where('status', 'Process')->findAll();
        $data['finish'] = $this->ordersModel->where('status', 'Finish')->findAll();
        $data['reject'] = $this->ordersModel->where('status', 'Rejected')->findAll();
        $data['users'] = $this->usersModel->findAll();

        return view('admin/orders', $data);
    }

    public function manage_product()
    {
        $data = [];
        $data['custom_gif'] = $this->productsModel->where('sub_category', 'custom_gif')->findAll()[0];
        $data['template_gif'] = $this->productsModel->where('sub_category', 'template_gif')->findAll()[0];
        $data['banner_event'] = $this->productsModel->where('sub_category', 'banner_event')->findAll()[0];
        $data['poster_event'] = $this->productsModel->where('sub_category', 'poster_event')->findAll()[0];
        $data['curriculum_vitae'] = $this->productsModel->where('sub_category', 'curriculum_vitae')->findAll()[0];

        return view('admin/products', $data);
    }

    public function manage_portofolios()
    {
        $data = [];
        $data['p_tpn'] = $this->portofoliosModel->where('category', 'twitter_profile_needs')->findAll();
        $data['p_if'] = $this->portofoliosModel->where('category', 'instagram_feeds')->findAll();
        $data['p_cd'] = $this->portofoliosModel->where('category', 'custom_design')->findAll();
        return view('admin/portofolios', $data);
    }

    public function promotions()
    {
        $data = [];
        $data['active'] = $this->promotionsModel->where('status', 'active')->findAll();
        $data['history'] = $this->promotionsModel->findAll();

        return view('admin/promotions', $data);
    }

    public function manage_user()
    {
        $data = [];
        $data['user'] = $this->usersModel->findAll();

        return view('admin/manage_user', $data);
    }

    //--------------------------------------------------------------------

}