<?php

namespace App\Models;

use CodeIgniter\Model;

class TemplateGIFModel extends Model
{
    protected $table = 'template_gif';
    protected $allowedFields = ['id', 'title', 'file', 'price', 'estimated_price'];

    public function getTemplate($id = null)
    {
        return $this->where('id', $id)->findAll();
    }
}