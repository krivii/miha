<?php

namespace App\Models;

use CodeIgniter\Model;

class MediaModel extends Model
{
    protected $table = 'media';
    protected $primaryKey = 'mediaid';
    protected $allowedFields = ['event', 'customerid', 'customeremail','name', 'path'];

    protected $useTimestamps = false;
    protected $createdField = 'created';
    // protected $updatedField = '';
    
}

