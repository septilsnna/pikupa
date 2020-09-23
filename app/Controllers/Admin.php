<?php

namespace App\Controllers;

use App\Models\OrderProgressModel;
use App\Models\OrdersModel;
use App\Models\ProductsModel;
use App\Models\PromotionsModel;
use App\Models\UsersModel;

class Admin extends BaseController
{
    protected $orderProgressModel;
    protected $ordersModel;
    protected $productsModel;
    protected $promotionsModel;
    protected $usersModel;

    public function __construct()
    {
        $this->orderProgressModel = new OrderProgressModel();
        $this->ordersModel = new OrdersModel();
        $this->productsModel = new ProductsModel();
        $this->promotionsModel = new PromotionsModel();
        $this->usersModel = new UsersModel();
    }

    public function dashboard()
    {
        return view('admin/dashboard');
    }

    //--------------------------------------------------------------------

}