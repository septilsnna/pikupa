<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductsModel extends Model
{
    protected $table = 'products';
    protected $allowedFields = ['stock', 'sold', 'discount', 'price'];
    protected $useTimestamps = true;
}