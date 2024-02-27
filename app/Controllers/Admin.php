<?php
namespace App\Controllers;
use App\Controllers\BaseController;

class Admin extends BaseController
{
    public function index()
    {
        
            $data = [
                'judul' => 'Dashboard',
                'subjudul' => '',
                'menu' => 'dashboard',
                'submenu' => '',
                'page' => 'v_admin',
            ];
            return view('v_template', $data);
    }
       

        public function Penjualan()
        {
            $data = [
                'judul' => 'Penjualan',
                'subjudul' => '',
                'menu' => 'penjualan',
                'submenu' => '',
                'page' => 'v_penjualan',
            ];
            return view('v_template', $data);
        }

        public function Setting()
        {
            $data = [
                'judul' => 'Setting',
                'subjudul' => '',
                'menu' => 'setting',
                'submenu' => '',
                'page' => 'v_setting',
            ];
            return view('v_template', $data);
        }

        

        
}

