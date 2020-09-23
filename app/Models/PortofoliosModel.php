<?php

namespace App\Models;

use CodeIgniter\Model;

class PortofoliosModel extends Model
{
    protected $table = 'portofolios';
    protected $allowedFields = ['category', 'file'];
    //protected $useTimestamps = true;
}