<?php

namespace App\Models;

use CodeIgniter\Model;

class OrdersModel extends Model
{
    protected $table = 'orders';
    protected $allowedFields = ['id', 'user_id', 'product_id', 'product_name', 'note', 'contact_method', 'contact', 'payment_method', 'order_date', 'status', 'total_payment'];
    //protected $useTimestamps = true;
}