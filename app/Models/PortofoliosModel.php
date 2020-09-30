<?php

namespace App\Models;

use CodeIgniter\Model;

class PortofoliosModel extends Model
{
    protected $table = 'portofolios';
    protected $allowedFields = ['category', 'file'];
    //protected $useTimestamps = true;

    public function getPortofolio($category, $note)
    {
        return $this->where(array('category' => $category, 'note' => $note))->findAll();
    }
}