<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPelanggan;

class Pelanggan extends BaseController
{
    
    public function __construct()
    {
        $this->ModelPelanggan = new ModelPelanggan();
    }

    public function index()
    {
        $data = [
            'judul' => 'Master Data',
            'subjudul' => 'Pelanggan',
            'menu' => 'masterdata',
            'submenu' => 'pelanggan',
            'page' => 'v_pelanggan',
            'pelanggan' => $this->ModelPelanggan->AllData(),
        ];
        return view('v_template', $data);
    }
    public function InsertData()
    {
        if($this->validate([
            'nama_pelanggan' => [
                'label' => 'Nama Pelanggan',
                'rules' => 'alpha_space',
                'errors' => [
                    'alpha_space' => '{field} Hanya Dapat Diisi Dengan Alphabet dan Spasi'
                ]
            ],
            'nomor_telpon' => [
                'label' => 'Nomor Telepon',
                'rules' => 'is_unique[pelanggan.nomor_telpon]',
                'errors' => [
                    'is_unique' => '{field} Sudah Ada, Masukan Nomor Yang Lain !!',
                ]
            ]
        ])) {
            $data = [
                
                'kode_pelanggan' => $this->request->getPost('kode_pelanggan'),
                'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
                'alamat' => $this->request->getPost('alamat'),
                'nomor_telpon' => $this->request->getPost('nomor_telpon'),
                
            ];
    
        
            $this->ModelPelanggan->InsertData($data);
            session()->setFlashdata('pesan','Data Berhasil Ditambahkan !!');
            return redirect()->to('Pelanggan');
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Pelanggan'))->withInput('validation', \Config\Services::validataion());
        }
    }

    public function UpdateData($id_pelanggan)
    {
            $data = [
                'id_pelanggan' => $id_pelanggan,
                'kode_pelanggan' => $this->request->getPost('kode_pelanggan'),
                'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
                'alamat' => $this->request->getPost('alamat'),
                'nomor_telpon' => $this->request->getPost('nomor_telpon'),   
            ];

        
            $this->ModelPelanggan->UpdateData($data);
            session()->setFlashdata('pesan','Data Berhasil DiUpdate !!');
            return redirect()->to('Pelanggan');
        
}

    public function DeleteData($id_pelanggan)
    {
        $data = [
            'id_pelanggan' => $id_pelanggan,
            
        ];

        $this->ModelPelanggan->DeleteData($data);
        session()->setFlashdata('pesan','Data Berhasil Dihapus !!');
        return redirect()->to('Pelanggan');
    }

    public function getKode() {
        $kode = $this->ModelPelanggan->getKode();
        return $this->response->setJSON(['kode' => $kode]);
    }

   
}