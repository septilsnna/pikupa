<?php

namespace App\Models;

use CodeIgniter\Model;

class OrdersModel extends Model
{
    protected $table = 'orders';
    protected $createdField = 'order_date';
    protected $allowedFields = ['id', 'user_id', 'nama_user', 'email_user', 'product_id', 'product_name', 'note', 'contact_method', 'contact', 'payment_method', 'proof_of_payment', 'id_card', 'order_date', 'status', 'total_payment', 'updated_at'];
    protected $useTimestamps = true;

    public function getOrder($id = null)
    {
        if ($id == null) {
            return $this->findAll();
        } else {
            return $this->where('user_id', $id)->findAll();
        }
    }
}