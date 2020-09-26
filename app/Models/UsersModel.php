<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['id', 'name', 'email', 'password', 'order_freq'];
    //protected $useTimestamps = true;
}