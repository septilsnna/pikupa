<?php

namespace App\Models;

use CodeIgniter\Model;

class PromotionsModel extends Model
{
    protected $table = 'promotions';
    protected $allowedFields = ['title', 'file', 'price', 'status'];
}