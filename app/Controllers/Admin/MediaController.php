<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\MediaModel;

use App\Models\UserModel;


class MediaController extends BaseController
{
    public function index(){

        $modelMedia = new MediaModel();
        $modelUser = new UserModel();

        $data = [
            'meta_title' => 'Media list',
            'media' => $modelMedia->orderBy('mediaid', 'DESC')->findAll()
        ];
        
        echo view('home/header', $data);
        echo view('media/media_list', $data);
        echo view('home/footer_admin');
    
    }

    public function search(){
        $query = $this->request->getGet('query');

        $model = new MediaModel();
    
        if ($query) {
            $files = $model->groupStart()
                ->like('customeremail', $query)
                ->orLike('event', $query)
                ->groupEnd()
                ->findAll();
    
            if ($files) {
                $data = [
                    'meta_title' => 'Media list',
                    'media' => $files
                ];
                echo view('home/header', $data);
                echo view('media/media_list', $data);
                echo view('home/footer_admin');
            } else {
                $data = [
                    'meta_title' => 'Media list',
                    
                ];
                echo view('home/header', $data);
                echo "<h2>No files found</h2>";
                echo view('home/footer_admin');
            }
        } else {
            
            $data = [
                'meta_title' => 'Media list',
                'media' => $model->findAll()
            ];
            echo view('home/header', $data);
            echo view('media/media_list', $data);
            echo view('home/footer_admin');
        }
    }

    public function addMedia(){

        $model = new MediaModel();
        $userModel = new UserModel();


        if($this->request->is('post')){

            $event = $this->request->getPost('event');

            helper(['form']);
   

            $rules = [
                'event' => [
                    'rules' => 'required|min_length[2]|max_length[150]',
                    'errors' => [
                        'required' => 'Event name is required.',
                        'min_length' => 'Event name must have min 2 characters.',
                        'max_length' => 'Event name can have max 150 characters.'
                    ]
                ],
                'media' => [
                    'rules' => 'uploaded[media.0]|is_image[media]',
                    'errors' => [
                        'uploaded' => 'Please select a file.',
                        'is_image' => 'File must be an image.'
                    ]
                ]
            ];
                       

            if($this->validate($rules)){

                $files = $this->request->getFiles();
                foreach ($files['media'] as $file){
                    if ($file->isValid() && !$file->hasMoved()){

                        $customerID = $this->request->getPost('customer');
                        $customer = $userModel->find($customerID);


                        $name = $file->getName(); 
                        $file->move('./uploads/images/userid='. $customerID);
                        $path = '/uploads/images'. '/userid='.$customerID . '/' . $file->getName();


                        $mediaData = [
                            'event' => $event, 
                            'customerid' => $customer['userid'],
                            'customeremail' => $customer['email'],
                            'name' => $name,
                            'path' => $path
                        ];

                        try {
                            $model->insert($mediaData);

                       
            
                        } catch (\Exception $e) {
                            
                            echo 'Error: ' . $e->getMessage();
                        }

                    }

                    $data = [
                        'meta_title' => 'Media list',
                        'validation' => $this->validator
                    ];


                }

                echo view('home/header', $data);
                echo view('media/media_add', ['added' => 'Media added.', 'users' => $userModel->findAll()]);
                echo view('home/footer_admin');

            }else{
                $data = [
                    'meta_title' => 'Media list',
                    'validation' => $this->validator
                ];

                echo view('home/header', $data);
                echo view('media/media_add', ['added' => '', 'users' => $userModel->findAll()]);
                echo view('home/footer_admin');
            }
                

        }
    }

    public function showEditForm($mediaid){

        $model = new MediaModel();
        $media = $model->find($mediaid);
    
        if ($media) {
            $data = [
                'meta_title' => 'User edit',
                'media' => $media
            ];
            echo view('home/header', $data);
            echo view('media/media_edit', $data);
            echo view('home/footer');
            
        } else {
            $data = [
                'meta_title' => 'Error',
                
            ];
            echo view('home/header', $data);
            echo "<h2>Media not found</h2>";
            echo view('home/footer_admin');
        }
    }

    public function showAddMediaForm(){

        $userModel = new UserModel();

        $data = [
            'meta_title' => 'Add media',
            
        ];

        echo view('home/header', $data);
        echo view('media/media_add', ['added' => '', 'users' => $userModel->findAll()]);
        echo view('home/footer_admin');
    }

    public function edit($mediaid){
        if($this->request->is('post')){

            $customeremail = $this->request->getPost('customeremail');
            $event = $this->request->getPost('event');
            $path = $this->request->getPost('path');
    

            if ($customeremail && $event && $path) {

                $model = new MediaModel();
    

                $media = $model->find($mediaid);
    
                if ($media) {

                    $media['customeremail'] = $customeremail;
                    $media['event'] = $event;
                    $media['path'] = $path;


                    $model->save($media);
    

                    return redirect()->to('admin/photos');
                } else {
                    echo "Photo not found";
                }
            } else {
                echo "Please provide all form values";
            }
        }
    }

    public function delete($mediaid)
    {
        $model = new MediaModel();
        $media = $model->find($mediaid);
        
        if ($media) {
            
            if ($this->request->is('post')) {
                
                $model->delete($mediaid);

                $filePath = '.' . $media['path'];

                if (file_exists($filePath)) {
                    unlink($filePath);
                    $this->deleteDirectory($filePath);
                } else {
                    echo('FILE PATH NO EXISTO');
                }

                return redirect()->to('admin/photos');
            }
        } else {
            echo "User not found";
        }
    }

    private function deleteDirectory($filePath)
    {
        $parts = explode('/', $filePath);

        array_pop($parts);

        $directoryPath = implode('/', $parts);

        $fileCount = count(glob($directoryPath . '/*'));

        if ($fileCount === 1) {
            $files = glob($directoryPath . '/*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }

            rmdir($directoryPath);
        }
    }

    public function downloadZip()
    {
        // Get the list of media files from your data source (e.g., database)

        // Generate a temporary file path for the zip file
        $zipFilePath = WRITEPATH . 'temp/temp.zip';

        // Create a new ZipArchive instance
        $zip = new ZipArchive();

        // Open the zip file for writing
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            // Loop through the media files and add them to the zip archive
            foreach ($mediaFiles as $mediaFile) {
                $filePath = FCPATH . $mediaFile['path']; // Adjust the file path based on your file storage
                $zip->addFile($filePath);
            }

            // Close the zip file
            $zip->close();

            // Set appropriate headers for the download
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="media.zip"');
            header('Content-Length: ' . filesize($zipFilePath));

            // Read the zip file and output its contents
            readfile($zipFilePath);

            // Delete the temporary zip file
            unlink($zipFilePath);
        } else {
            // Failed to create the zip file
            // Handle the error accordingly
        }
    }
}