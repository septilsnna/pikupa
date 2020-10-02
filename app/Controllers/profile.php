<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\OrdersModel;

class profile extends BaseController
{
    protected $usersModel;
    protected $ordersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->ordersModel = new OrdersModel();
    }

    public function index()
    {
        $order = $this->ordersModel->getOrder($_SESSION['user_id']);

        $this->usersModel
            ->where('id', $_SESSION['user_id'])
            ->set(['order_freq' => count($order)])
            ->update();

        $user = $this->usersModel->getUser($_SESSION['user_id']);
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
        $user = $this->usersModel->getUser($_SESSION['user_id']);
        $nama = explode(" ", $user[0]['name']);

        $data = [
            'user' => $user,
            'nama' => $nama[0],
        ];

        return view('users/kelola_akun', $data);
    }

    public function connection()
    {
        $user = $this->usersModel->getUser($_SESSION['user_id']);
        $nama = explode(" ", $user[0]['name']);

        $data = [
            'user' => $user,
            'nama' => $nama[0],
        ];

        return view('users/akun_tertaut', $data);
    }

    //--------------------------------------------------------------------

}