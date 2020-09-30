<?php

namespace App\Controllers;

class register extends BaseController
{
    public function index()
    {
        if (isset($_SESSION['user_id'])) {
            return redirect()->to('../Home/index');    // users	no
        } else {
            $data['validation'] = \Config\Services::validation();
            return view('guests/register', $data);    // guests	yes
        }
    }

    //--------------------------------------------------------------------

}