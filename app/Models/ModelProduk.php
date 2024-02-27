<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelProduk extends Model
{
    public function AllData()
    {
        return $this->db->table('tbl_produk')
        ->get()
        ->getResultArray();
    }

    public function InsertData($data)
    {
        $this->db->table('tbl_produk')->insert($data);
    }
   

    public function UpdateData($data)
    {
        $this->db->table('tbl_produk')
        ->where('id_produk ='. $data['id_produk'])
        ->update($data);
    }

    public function DeleteData($data)
    {
        $this->db->table('tbl_produk')
        ->where('id_produk ='. $data['id_produk'])
        ->delete($data);
    }


public function getProdukByKode($kode_produk) {
    return $this->db->table('tbl_produk')
        ->where('kode_produk', $kode_produk)
        ->get()
        ->getResultArray();
}

public Function getKode() {
    $kode = $this->db->table('tbl_produk')
    ->select('kode_produk')
    ->orderBy('kode_produk', 'DESC')
    ->get()
    ->getRow();

    if(isset($kode)) {
        $kode = $kode->kode_produk;
        preg_match('/(\d+)$/', $kode, $matches);
        $number = intval($matches[0]);
        $number++;
        
        return 'BRG' . str_pad($number, strlen($matches[0]), '0', STR_PAD_LEFT);
    }else {
        return 'BRG';
    }
}
}