<?php

namespace App\Controllers;

date_default_timezone_set("Asia/Bangkok");

use App\Models\OrdersModel;
use App\Models\ProductsModel;
use App\Models\PortofoliosModel;
use App\Models\PromotionsModel;
use App\Models\UsersModel;

class ConfigAdmin extends BaseController
{
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

    public function reject($param)
    {
        $this->ordersModel
            ->where('id', $param)
            ->set(['status' => 'Rejected'])
            ->update();

        return redirect()->to('../Admin/orders');
    }

    public function process($param)
    {
        $this->ordersModel
            ->where('id', $param)
            ->set(['status' => 'Process'])
            ->update();

        return redirect()->to('../Admin/orders');
    }

    public function finish($order_id, $product_id, $user_id)
    {
        $this->ordersModel
            ->where('id', $order_id)
            ->set(['status' => 'Finish'])
            ->update();

        $sold = $this->productsModel->where('id', $product_id)->findAll();

        $this->productsModel
            ->where('id', $product_id)
            ->set(['sold' => (int)$sold[0]['sold'] + 1])
            ->update();

        $order_freq = $this->usersModel->where('id', $user_id)->findAll();

        $this->usersModel
            ->where('id', $user_id)
            ->set(['order_freq' => (int)$order_freq[0]['order_freq'] + 1])
            ->update();

        return redirect()->to('../Admin/orders');
    }

    public function edit_product($param)
    {
        $data = [
            'stock' => $this->request->getVar('stock'),
            'price' => $this->request->getVar('price'),
            'discount' => $this->request->getVar('discount')
        ];

        $this->productsModel
            ->where('id', $param)
            ->set($data)
            ->update();

        return redirect()->to('../Admin/manage_product');
    }

    public function add_portofolios()
    {
        $file = $this->request->getFile('file');            // ambil file bukti bayar
        $nama = $file->getRandomName();                     // generate nama random
        $note = $this->request->getVar('note');
        $file->move($note, $nama);                          // pindahkan ke folder note

        $data = [
            'category' => $this->request->getVar('category'),
            'file' => $nama,
            'note' => $note
        ];

        $this->portofoliosModel->insert($data);

        return redirect()->to('../Admin/manage_portofolios');
    }

    public function inactivated($id)
    {
        $this->promotionsModel
            ->where('id', $id)
            ->set(['status' => 'inactive'])
            ->update();

        return redirect()->to('../Admin/promotions');
    }

    public function add_promotions()
    {
        $file = $this->request->getFile('promotion');     // ambil file bukti bayar
        $nama = $file->getRandomName();                   // generate nama random
        $file->move('promotions', $nama);                 // pindahkan ke folder promotions

        $data = [
            'title' => $this->request->getVar('title'),
            'file' => $nama,
            'price' => $this->request->getVar('price'),
            'status' => 'active'
        ];

        $this->promotionsModel->insert($data);

        return redirect()->to('../Admin/promotions');
    }

    //--------------------------------------------------------------------

}