<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelProduk;
use \Dompdf\Dompdf;

class Produk extends BaseController
{
    public function __construct()
    {
        $this->ModelProduk = new ModelProduk();
    }

    public function index()
    {
        
        $data = [
            'judul' => 'Master Data',
            'subjudul' => 'Produk',
            'menu' => 'masterdata',
            'submenu' => 'produk',
            'page' => 'v_produk',
            'produk' => $this->ModelProduk->AllData(),
        ];
        return view('v_template', $data);
    }

    public function InsertData()
    {
        if ($this->validate([
            'kode_produk' => [
                'label' => 'Kode Produk',
                'rules' => 'is_unique[tbl_produk.kode_produk]',
                'errors' => [
                    'is_unique' => '{field} Sudah Ada, Masukan Kode Yang Lain !!',
                    ]
                ],
             'nama_produk' => [
                'label' => 'Nama Produk',
                'rules' => 'is_unique[tbl_produk.nama_produk]',
                'errors' => [
                    'is_unique' => '{field} Sudah Ada, Masukan Produk Yang Lain !! !',
                    ]
                ]
                
        ])) {
            $hargabeli = str_replace(",","", $this->request->getPost('harga_beli'));
            $hargajual = str_replace(",","", $this->request->getPost('harga_jual'));
            $data = [
                'kode_produk' => $this->request->getPost('kode_produk'),
                'nama_produk' => $this->request->getPost('nama_produk'),
                'harga_beli' => $hargabeli,
                'harga_jual' => $hargajual,
                'stok_produk' => $this->request->getPost('stok_produk'),
                
            ];
            $this->ModelProduk->InsertData($data);
            session()->setFlashdata('pesan','Data Berhasil Ditambahkan !!');
            return redirect()->to('Produk');
            
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Produk'))->withInput('validation', \Config\Services::validataion());
          }
    
        
    }

    public function UpdateData($id_produk)
    {

            $data = [
                'id_produk' => $id_produk,
                'kode_produk' => $this->request->getPost('kode_produk'),
                'nama_produk' => $this->request->getPost('nama_produk'),
                'harga_beli' => $this->request->getPost('harga_beli'),
                'harga_jual' => $this->request->getPost('harga_jual'),
                'stok_produk' => $this->request->getPost('stok_produk'),
            ];

        
            $this->ModelProduk->UpdateData($data);
            session()->setFlashdata('pesan','Data Berhasil DiUpdate !!');
            return redirect()->to('Produk');
        }  
            

    public function DeleteData($id_produk)
    {
        $data = [
            'id_produk' => $id_produk,
            
        ];

    
        $this->ModelProduk->DeleteData($data);
        session()->setFlashdata('pesan','Data Berhasil Dihapus !!');
        return redirect()->to('Produk');
    }

    public function getKode() {
        $kode = $this->ModelProduk->getKode();
        return $this->response->setJSON(['kode' => $kode]);
    }

    public function printpdf()
    {
        $data = [
            'kode_produk' => $this->request->getPost('kode_produk'),
            'nama_produk' => $this->request->getPost('nama_produk'),
            'harga_beli' => $this->request->getPost('harga_beli'),
            'harga_jual' => $this->request->getPost('harga_jual'),
            'stok_produk' => $this->request->getPost('stok_produk'),
        ];
        $dompdf = new Dompdf();
        $html = view('v_produk', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4','landscape');
        $dompdf->render();
        $dompdf->stream();
        $dompdf->stream('data produk.pdf',array(
            "Attachment" => false
        ));
    }
 }


