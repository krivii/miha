<?php

namespace App\Models;

use CodeIgniter\Model;

class InteractionModel extends Model
{
    protected $table = 'interaction';
    protected $primaryKey = 'interactionid';
    protected $allowedFields = ['useremail','subject', 'message', 'created'];

    protected $useTimestamps = false;
    protected $createdField = 'created';
    // protected $updatedField = '';
    
}

