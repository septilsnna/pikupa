<?php

namespace App\Models;

use CodeIgniter\Model;

class OrdersModel extends Model
{
    protected $table = 'orders';
    protected $createdField = 'order_date';
    protected $allowedFields = ['id', 'user_id', 'nama_user', 'email_user', 'product_id', 'product_name', 'note', 'contact_method', 'contact', 'payment_method', 'order_date', 'status', 'total_payment', 'updated_at'];
    protected $useTimestamps = true;
}