<?php

namespace App\Controllers;

class login extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Masuk'
        ];

        if (isset($_SESSION['user_id'])) {
            return redirect()->to('../home/index');           // users	no
        } else {
            return view('guests/login', $data);        // guests	yes
        }
    }

    //--------------------------------------------------------------------

}