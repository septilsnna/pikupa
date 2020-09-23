<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderProgressModel extends Model
{
    protected $table = 'order_progress';
    protected $allowedFields = ['order_id', 'status', 'updated_at'];
    protected $useTimestamps = true;
}