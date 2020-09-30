<?php

namespace App\Controllers;

class register extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Daftar'
        ];

        if (isset($_SESSION['user_id'])) {
            return redirect()->to('../Home/index');    // users	no
        } else {
            return view('guests/register', $data);    // guests	yes
        }
    }

    //--------------------------------------------------------------------

}