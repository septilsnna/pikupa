<?php

namespace App\Controllers;

use App\Models\UsersModel;

class verification extends BaseController
{
    protected $usersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }

    public function token($token)
    {
        $user = $this->usersModel->where('token', $token)->findAll();
        // kalo token tidak valid
        if (!$user) {
            echo "Link verifikasi tidak valid!";
        } else {
            // kalo udah di verif
            if ($user[0]['verified'] == 1) {
                echo "Email sudah diverifikasi";
            } else {
                // kalo belom di verif
                $this->usersModel
                    ->where('token', $token)
                    ->set(['verified' => 1])
                    ->update();
                echo "Email berhasil diverifikasi";
            }
        }
    }

    //--------------------------------------------------------------------

}