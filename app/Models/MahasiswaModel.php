<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 'mahasiswa';
    protected $allowedFields = ['nama', 'email', 'id_kelas', 'password', 'password_hash'];

    public function insertPassword($id, $data)
    {
        $this->builder()->where('id', $id)->update($data);
    }

    public function getAllMahasiswa()
    {
        return $this->builder()->get()->getResultArray();
    }
}