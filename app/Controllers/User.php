<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelUser;

class User extends BaseController
{
    public function __construct()
    {
        $this->ModelUser = new ModelUser();
    }
    public function index()
    {
        $data = [
            'judul' => 'User',
            'subjudul' => 'User',
            'menu' => 'masterdata',
            'submenu' => 'user',
            'page' => 'v_user',
            'user' => $this ->ModelUser->AllData(),
        ];
        return view('v_template', $data);
    }
    public function InsertData()
    {
        if ($this->validate([
            'kode_user' => [
                'label' => 'Kode User',
                'rules' => 'is_unique[tbl_user.kode_user]',
                'errors' => [
                    'is_unique' => '{field} Sudah Ada, Masukan Kode Yang Lain !!',
                    
                    ]
                ],
             'email' => [
                'label' => 'Email',
                'rules' => 'is_unique[tbl_user.email]',
                'errors' => [
                    'is_unique' => '{field} Sudah Ada, Masukan Email Yang Lain !!',
                    
                    ]
                ]
                
        ])) {

        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('User'))->withInput('validation', \Config\Services::validataion());
          }
        $data = [
            'kode_user' => $this->request->getPost('kode_user'),
            'nama_user' => $this->request->getPost('nama_user'),
            'email' => $this->request->getPost('email'),
            'password' => sha1($this->request->getPost('password')),
            'level' => $this->request->getPost('level'),
           
        ];
    
        $this->ModelUser->InsertData($data);
        session()->setFlashdata('pesan','Data Berhasil Ditambahkan !!');
        return redirect()->to('User');
    }

    public function UpdateData($id_user)
    {
        $data = [
            'id_user' => $id_user,
            'kode_user' => $this->request->getPost('kode_user'),
            'nama_user' => $this->request->getPost('nama_user'),
            'email' => $this->request->getPost('email'),
            'password' => sha1($this->request->getPost('password')),
            'level' => $this->request->getPost('level'),
           
            
        ];

    
        $this->ModelUser->UpdateData($data);
        session()->setFlashdata('pesan','Data Berhasil DiUpdate !!');
        return redirect()->to('User');
    }

    public function DeleteData($id_user)
    {
        $data = [
            'id_user' => $id_user,
            
        ];

        $this->ModelUser->DeleteData($data);
        session()->setFlashdata('pesan','Data Berhasil Dihapus !!');
        return redirect()->to('User');
    }

    public function getKode() {
        $kode = $this->ModelUser->getKode();
        return $this->response->setJSON(['kode' => $kode]);
    }

 }
