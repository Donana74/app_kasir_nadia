<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPelanggan extends Model
{
    public function AllData()
    {
        return $this->db->table('pelanggan')
        ->get()
        ->getResultArray();
    }

    public function InsertData($data)
    {
        $this->db->table('pelanggan')->insert($data);
    }

    public function UpdateData($data)
    {
        $this->db->table('pelanggan')
        ->where('id_pelanggan ='. $data['id_pelanggan'])
        ->update($data);
    }

    public function DeleteData($data)
    {
        $this->db->table('pelanggan')
        ->where('id_pelanggan ='. $data['id_pelanggan'])
        ->delete($data);
    }

    public Function getKode() {
        $kode = $this->db->table('pelanggan')
        ->select('kode_pelanggan')
        ->orderBy('kode_pelanggan', 'DESC')
        ->get()
        ->getRow();

        if(isset($kode)) {
            $kode = $kode->kode_pelanggan;
            preg_match('/(\d+)$/', $kode, $matches);
            $number = intval($matches[0]);
            $number++;
            
            return 'PLG' . str_pad($number, strlen($matches[0]), '0', STR_PAD_LEFT);
        }else {
            return 'PLG';
        }
    }
}