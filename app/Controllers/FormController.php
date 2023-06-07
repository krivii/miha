<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\HomeController;

class FormController extends BaseController
{
    public function addUser()
    {


        if($this->request->is('post')){

            helper(['form']);

            $rules = [
                'first_name' => [
                    'rules'=> 'required|min_length[2]|max_length[20]|alpha_space',
                    'label'=> 'firstname'
                ],
                'last_name' => [
                    'rules'=> 'required|min_length[2]|max_length[20]|alpha_space',
                    'label'=> 'lastname'
                ],
                'date_of_birth' => [
                    'rules'=> 'required|valid_date',
                    'label'=> 'date of birth'
                ],
                'email' => [
                    'rules'=> 'required|valid_email|min_length[6]|max_length[50]',
                    'label'=> 'email address'
                ],
                'password' =>  [
                    'rules'=> 'required|min_length[6]|max_length[50]|alpha_numeric_punct',
                    'errors'=> [
                        'min_length' => 'Password must be at least 6 characters in length',
                        'max_length' => 'Password cannot exceed 50 characters in length.',
                        'alpha_numeric_punct' => 'Please use only these characters ~ ! # $ % & * - _ + = | : .'
                   ]
                ],
                'password_repeat' => [
                    'rules'=> 'required|matches[password]',
                    'errors'=> [
                        'required' => 'Please repeat password.',
                        'matches' => "Passwords don't match",
                        ]
                ],
            ];

            if($this->validate($rules)){

                $model = new UserModel();
                
                $firstName = $this->request->getPost('first_name');
                $lastName = $this->request->getPost('last_name');
                $email = $this->request->getPost('email');
                $dateOfBirth = $this->request->getPost('date_of_birth');
                $howDidYouFindMe = $this->request->getPost('how_did_you_find_me');
                $password = $this->request->getPost('password');

                if (!$model->checkEmail($email)) {
                    echo 'Email already exists';
                    return;
                }
                
                $data = [
                    'firstname' => $firstName,
                    'lastname' => $lastName,
                    'dateofbirth' => $dateOfBirth,
                    'howdidyoufindme' => $howDidYouFindMe,
                    'email' => $email,
                    'password' => $password
                ];
        
                try {
                    $model->insert($data);

                    $lastInsertedId = $model->db->insertID();


                    $dataSes = [
                        'email' => $email,
                        'firstname' => $firstName,
                        'isLoggedIn' => true,
                    ];


                    return redirect()->to('library');

                } catch (\Exception $e) {
                    
                    echo 'Error: ' . $e->getMessage();
                }
            }else{
                $data = [
                    'meta_title' => 'Registration',
                    'validation' => $this->validator
                ];
                echo view('home/header', $data);
                echo view('home/registration', ['added' => '']);
                echo view('home/footer');
            }
        }

    }

}


