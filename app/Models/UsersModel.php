<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['id', 'name', 'email', 'token', 'verified', 'password', 'regist_via', 'order_freq'];
    //protected $useTimestamps = true;

    public function getUser($id = null)
    {
        if ($id == null) {
            return $this->findAll();
        } else {
            return $this->where('id', $id)->findAll();
        }
    }
}