<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'userid';
    protected $allowedFields = ['firstname', 'lastname', 'dateofbirth', 'howdidyoufindme', 'email', 'password'];

    protected $useTimestamps = false;
    protected $createdField = 'created';
    
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeInsert'];

    protected function beforeInsert(array $data){
        $data = $this->passwordHash($data);
        return $data;
    }

    protected function beforeUpdate(array $data){
        $data = $this->passwordHash($data);
        return $data;
    }
    

    public function checkEmail($email)
    {
        $existingUser = $this->where('email', $email)->first();
        if ($existingUser) {
            return false;
        }
        return true;
    }

    protected function passwordHash(array $data){
        if(isset($data['data']['password'])){

            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        
        return $data;
    }


}

