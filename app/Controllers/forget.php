<?php

namespace App\Controllers;

class forget extends BaseController
{
    public function index($token)
    {
        $data['validation'] = \Config\Services::validation();
        $data['token'] = $token;
        return view('guests/forget_password', $data);
    }

    //--------------------------------------------------------------------

}