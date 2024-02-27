<?php
namespace App\Controllers;
use App\Controllers\BaseController;

class Laporan extends BaseController
{
    public function print()
    {
        $data = [
            'judul' => 'Laporan',
            'subjudul' => 'Produk',
            'menu' => 'masterdata',
            'submenu' => 'produk',
            'page' => 'v_produk',
            'produk' => $this->ModelProduk->AllData(),
        ];
        return view('v_template_print_laporan', $data);
    }
}