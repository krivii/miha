<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        $model = new UserModel();

        $data = [
            'meta_title' => 'User list',
            'users' => $model->orderBy('userid', 'DESC')->findAll()
        ];
        echo view('home/header', $data);
        echo view('user/user_list', $data);
        echo view('home/footer_admin');
        
    }

    public function search()
    {
        $query = $this->request->getGet('query');

        $model = new UserModel();
    
        if ($query) {
            $users = $model->groupStart()
                ->like('firstname', $query)
                ->orLike('lastname', $query)
                ->orLike('email', $query)
                ->groupEnd()
                ->findAll();
    
            if ($users) {
                $data = [
                    'meta_title' => 'User list',
                    'users' => $users
                ];
                echo view('home/header', $data);
                echo view('user/user_list', $data);
                echo view('home/footer_admin');
            } else {
                $data = [
                    'meta_title' => 'User list',
                    
                ];
                echo view('home/header', $data);
                echo "<h2>No users found</h2>";
                echo view('home/footer_admin');
            }
        } else {
            
            $data = [
                'meta_title' => 'User list',
                'users' => $model->findAll()
            ];
            echo view('home/header', $data);
            echo view('user/user_list', $data);
            echo view('home/footer');
        }
    }

    public function showEditForm($userId)
    {

        $model = new UserModel();
        $user = $model->find($userId);
    
        if ($user) {
            $data = [
                'meta_title' => 'User edit',
                'user' => $user
            ];
            echo view('home/header', $data);
            echo view('user/user_edit', $data);
            echo view('home/footer_admin');
            
        } else {
            $data = [
                'meta_title' => 'Error',
                
            ];
            echo view('home/header', $data);
            echo "<h2>User not found</h2>";
            echo view('home/footer_admin');
        }
    }

    public function edit($userId)
    {

        if($this->request->is('post')){

            $firstName = $this->request->getPost('first_name');
            $lastName = $this->request->getPost('last_name');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
    
 
            if ($firstName && $lastName && $email && $password) {
    
                $model = new UserModel();
    
      
                $user = $model->find($userId);
    
                if ($user) {
 
                    $user['firstname'] = $firstName;
                    $user['lastname'] = $lastName;
                    $user['email'] = $email;
                    $user['password'] = $password;
                    
                    // Save the updated user
                    $model->save($user);
    
                    // Redirect to a specific route
                    return redirect()->to('admin/users');
                } else {
                    echo "User not found";
                }
            } else {
                echo "Please provide all form values";
            }
        }

    }
    
    public function delete($userId)
    {
        $model = new UserModel();
        $user = $model->find($userId);
        
        if ($user) {
            
            if($this->request->is('post')){
                
                $model->delete($userId);
                return redirect()->to('admin/users');
            }

        } else {
            echo "User not found";
        }
    }

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
                $password = $this->request->getPost('password');

                if (!$model->checkEmail($email)) {
                    echo 'Email already exists';
                    return;
                }
                
                $data = [
                    'firstname' => $firstName,
                    'lastname' => $lastName,
                    'dateofbirth' => $dateOfBirth,
                    'howdidyoufindme' => 'Admin made',
                    'email' => $email,
                    'password' => $password
                ];
        
                try {
                    $model->insert($data);

                    return redirect()->to('admin/users');

                } catch (\Exception $e) {
                    
                    echo 'Error: ' . $e->getMessage();
                }
            }else{
                $data = [
                    'meta_title' => 'Registration',
                    'validation' => $this->validator
                ];
                echo view('home/header', $data);
                echo view('user/user_add', ['added' => '']);
                echo view('home/footer_admin');
            }
        }

    }

    public function showAddUserForm()
    {
        $data = [
            'meta_title' => 'Registration'
        ];

        echo view('home/header', $data);
        echo view('user/user_add', ['added' => '']);
        echo view('home/footer_admin');
    }
}