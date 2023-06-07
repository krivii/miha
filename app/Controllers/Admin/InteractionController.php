<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\UserModel;

use App\Models\InteractionModel;

class InteractionController extends BaseController
{
    public function index(){
        $model = new InteractionModel();

        $data = [
            'meta_title' => 'Messages list',
            'msgs' => $model->orderBy('interactionid', 'DESC')->findAll()
        ];
        echo view('home/header', $data);
        echo view('interaction/interaction_list', $data);
        echo view('home/footer_admin');
    }

    public function search(){
        $query = $this->request->getGet('query');

        $model = new InteractionModel();
    
        if ($query) {
            $msgs = $model->groupStart()
                ->like('message', $query)
                ->orLike('subject', $query)
                ->orLike('useremail', $query)
                ->groupEnd()
                ->findAll();
    
            if ($msgs) {
                $data = [
                    'meta_title' => 'Messages list',
                    'msgs' => $msgs
                ];
                echo view('home/header', $data);
                echo view('interaction/interaction_list', $data);
                echo view('home/footer_admin');
            } else {
                $data = [
                    'meta_title' => 'Messages list',
                    
                ];
                echo view('home/header', $data);
                echo "<h2>No messages found</h2>";
                echo view('home/footer_admin');
            }
        } else {
            
            $data = [
                'meta_title' => 'Messages list',
                'msgs' => $model->findAll()
            ];
            echo view('home/header', $data);
            echo view('interaction/interaction_list', $data);
            echo view('home/footer_admin');
        }
    }

    public function showAddInteractionForm(){
        $userModel = new InteractionModel();

        $data = [
            'meta_title' => 'Contact us',
            
        ];

        echo view('home/header', $data);
        echo view('home/contact', ['added' => '']);
        echo view('home/footer_admin');
    }

    public function addInteraction(){

        $model = new InteractionModel();


        if($this->request->is('post')){

            helper(['form']);

            $rules = [
                'useremail' => [
                    'rules'=> 'required|valid_email|min_length[6]|max_length[50]',
                    'label'=> 'email address'
                ],
                'subject' => [
                    'rules'=> 'required|min_length[2]|max_length[30]|alpha_space',
                    'label'=> 'subject'
                ],
                'message' => [
                    'rules'=> 'required|min_length[6]|max_length[5000]'
                ]
            ];

            if($this->validate($rules)){

                $userEmail = $this->request->getPost('useremail');
                $subject = $this->request->getPost('subject');
                $message = $this->request->getPost('message');

                
                $data = [
                    'useremail' => $userEmail,
                    'subject' => $subject,
                    'message' => $message,

                ];
        
                try {
                    $model->insert($data);

                    $data = [
                        'meta_title' => 'Success!'
                    ];
    
                    $data = [
                        'meta_title' => 'Contact us',
                        'validation' => $this->validator
                    ];
                    echo view('home/header', $data);
                    echo view('home/contact', ['added' => 'You have succesfully sent a message']);
                    echo view('home/footer_admin');


                } catch (\Exception $e) {
                    
                    echo 'Error: ' . $e->getMessage();
                }

                

            }else{
                $data = [
                    'meta_title' => 'Contact us',
                    'validation' => $this->validator
                ];
                echo view('home/header', $data);
                echo view('home/contact', ['added' => '']);
                echo view('home/footer_admin');
            }
        }
    }

    public function showEditForm($interactionid){
        $model = new InteractionModel();
        $msg = $model->find($interactionid);
    
        if ($msg) {
            $data = [
                'meta_title' => 'Message edit',
                'msg' => $msg
            ];
            echo view('home/header', $data);
            echo view('interaction/interaction_edit', $data);
            echo view('home/footer_admin');
            
        } else {
            $data = [
                'meta_title' => 'Error',
                
            ];
            echo view('home/header', $data);
            echo "<h2>Interaction not found</h2>";
            echo view('home/footer_admin');
        }
    }

    public function edit($interactionid){
        if($this->request->is('post')){

            $email = $this->request->getPost('useremail');
            $subject = $this->request->getPost('subject');
            $message = $this->request->getPost('message');
    

            if ($email && $subject && $message) {

                $model = new InteractionModel();

                $msg = $model->find($interactionid);
    
                if ($msg) {

                    $msg['useremail'] = $email;
                    $msg['subject'] = $subject;
                    $msg['message'] = $message;


                    $model->save($msg);
    

                    return redirect()->to('admin/messages');
                } else {
                    echo "Message not found";
                }
            } else {
                echo "Please provide all form values";
            }
        }
    }

    public function delete($interactionid){
        $model = new InteractionModel();
        $msg = $model->find($interactionid);
        
        if ($msg) {
            
            if($this->request->is('post')){
                
                $model->delete($interactionid);
                return redirect()->to('admin/messages');
            }

        } else {
            echo "Message not found";
        }
    }
}