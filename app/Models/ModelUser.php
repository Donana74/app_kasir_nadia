<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
    public function AllData()
    {
        return $this->db->table('tbl_user')
        ->get()
        ->getResultArray();
    }

    public function InsertData($data)
    {
        $this->db->table('tbl_user')->insert($data);
    }

    public function UpdateData($data)
    {
        $this->db->table('tbl_user')
        ->where('id_user ='. $data['id_user'])
        ->update($data);
    }

    public function DeleteData($data)
    {
        $this->db->table('tbl_user')
        ->where('id_user ='. $data['id_user'])
        ->delete($data);
    } 
    public function LoginUser($email, $password)
    {
        return $this->db->table('tbl_user')
        ->where([
            'email'=>$email,
            'password'=>$password,
        ])->get()->getRowArray();
    }

    public Function getKode() {
        $kode = $this->db->table('user')
        ->select('kode_user')
        ->orderBy('kode_user', 'DESC')
        ->get()
        ->getRow();

        if(isset($kode)) {
            $kode = $kode->kode_user;
            preg_match('/(\d+)$/', $kode, $matches);
            $number = intval($matches[0]);
            $number++;
            
            return 'USR' . str_pad($number, strlen($matches[0]), '0', STR_PAD_LEFT);
        }else {
            return 'USR';
        }
    }

}