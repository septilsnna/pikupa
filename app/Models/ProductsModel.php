<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductsModel extends Model
{
    protected $table = 'products';
    protected $allowedFields = ['stock', 'sold', 'discount', 'price', 'estimated_price'];
    protected $useTimestamps = true;

    public function getProduct($category = null)
    {
        return $this->where('category', $category)->findAll();
    }

    public function getSubProduct($category, $sub_category)
    {
        return $this->where(array('category' => $category, 'sub_category' => $sub_category))->findAll();
    }
}