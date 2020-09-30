<?php

namespace App\Controllers;

use App\Models\PortofoliosModel;
use App\Models\UsersModel;

class portofolios extends BaseController
{
    protected $portofoliosModel;
    protected $usersModel;

    public function __construct()
    {
        $this->portofoliosModel = new PortofoliosModel();
        $this->usersModel = new UsersModel();
    }

    public function index($param, $id)
    {
        $porto = $this->portofoliosModel->getPortofolio($param, $id);
        $style = "background-color: #FEB724; border: 1px solid rgba(0, 0, 0, 0.2); box-sizing: border-box; color:#424242";
        //var_dump($porto);

        if (isset($_SESSION['user_id'])) {
            $user = $this->usersModel->getUser($_SESSION['user_id']);
            $nama = explode(" ", $user[0]['name']);
            $data = [
                'title' => 'Halaman Portfolio',
                'portofolios' => $porto,
                'style' => $style,
                'id' => $id,
                'nama' => $nama[0]
            ];
            return view('users/' . $param . '/portofolio_' . $id, $data);        // users
        } else {
            $data = [
                'title' => 'Halaman Portfolio',
                'portofolios' => $porto,
                'style' => $style,
                'id' => $id
            ];
            return view('guests/' . $param . '/portofolio_' . $id, $data);        // guests
        }
    }

    //--------------------------------------------------------------------

}