<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\MediaModel;

class HomeController extends BaseController
{



    public function index()
    {
        $data = [
            'meta_title' => 'Miha Krivec'
        ];
        echo view('home/header', $data);
        echo view('home/home_page');
        echo view('home/footer');
    }

    public function about()
    {
        $data = [
            'meta_title' => 'About me'
        ];
        echo view('home/header', $data);
        echo view('home/about');
        echo view('home/footer');
    }

    public function videos()
    {
        $data = [
            'meta_title' => 'Videos'
        ];
        echo view('home/header', $data);
        echo view('home/videos');
        echo view('home/footer');
    }

    public function photos()
    {
        $data = [
            'meta_title' => 'Photos'
        ];
        echo view('home/header', $data);
        echo view('home/photos');
        echo view('home/footer');
    }

    public function library()
    {
        $modelMedia = new MediaModel();


        $id = session()->get('userid');

        $data = [
            'meta_title' => 'Library'            
        ];

        $media = [
            'images' => $modelMedia->where('customerid', $id)->findAll()
        ];


        echo view('home/header', $data);
        echo view('home/library', $media);
        echo view('home/footer');
    }

    public function login()
    {
        if($this->request->is('post')){
            helper(['form']);

            $rules = [

                'email' => 'required|valid_email|min_length[6]|max_length[50]',
                'password' =>   'min_length[6]|max_length[50]|alpha_numeric_punct|validateUser[email,password]',
                   
            ];

            $errors = [
                'password' => [
                    'validateUser' => "Wrong email or password."
                ]
            ];
            
            if($this->validate($rules, $errors)){

                $model = new UserModel();

                $user = $model->where('email', $this->request->getVar('email'))
                              ->first();

                $this->setUserMethod($user);

                return redirect()->to('library');
            }
            else{

                $data = [
                    'meta_title' => 'Login',
                    'validation' => $this->validator
                ];
                echo view('home/header', $data);
                echo view('home/login');
                echo view('home/footer');
            }
        }
    }

    private function setUserMethod($user) {
        $data = [
            'userid' => $user['userid'],
            'email' => $user['email'],
            'firstname' => $user['firstname'],
            'isLoggedIn' => true,
        ];
        
        session()->set($data);
    }

    public function getLoginForm(){

        $data = [
            'meta_title' => 'Login'
        ];
        echo view('home/header', $data);
        echo view('home/login',['added' => '']);
        echo view('home/footer');
    }

    public function showAddUserForm()
    {
        $data = [
            'meta_title' => 'Registration'
        ];
        echo view('home/header', $data);
        echo view('home/registration',['added' => '']);
        echo view('home/footer');
    }

    public function logout() {
        $dataSes = [
            'userid' => '',
            'firstname' => '',
            'isLoggedIn' => false,
        ];

        session()->set($dataSes);

        $data = [
            'meta_title' => 'Login'
        ];

        echo view('home/header', $data);
        echo view('home/login',['added' => '']);
        echo view('home/footer');
    }
    

    public function addInteraction()
    {
        $data = [
            'meta_title' => 'Contact me'
        ];
        echo view('home/header', $data);
        echo view('home/contact');
        echo view('home/footer');
    }

    public function showaddInteractionForm()
    {

        $data = [
            'meta_title' => 'Contact me'
        ];
        echo view('home/header', $data);
        echo view('home/contact');
        echo view('home/footer');
        
    }

    public function admin()
    {
        $data = [
            'meta_title' => 'Admin'
        ];
        echo view('home/header', $data);
        echo view('home/admin_page');
        echo view('home/footer_admin');
    }
}
