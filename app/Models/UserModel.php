<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'username',
        'email',
        'password',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'id'    => 'max_length[11]',
        'name' => 'required|max_length[32]',
        'username' => 'required|max_length[32]|is_unique[users.username,id,{id}]',
        'email' => 'required|max_length[32]|valid_email|is_unique[users.email,id,{id}]',
        'password' => 'required|max_length[32]',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['hashPassword'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ['hashPassword'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = ['hidePassword'];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected function hashPassword(array $data) {
        if (! isset($data['data']['password'])) {
            return $data;
        }
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
    }

    protected function hidePassword(array $data) {
        if ($data['method'] == 'first' || ($data['method'] == 'find' && $data['data']['id'])) {
            unset($data['data']['password']);
            return $data;
        }
        foreach ($data['data'] as $key => $user) {
            unset($data['data'][$key]['password']);
        }
        return $data;
    }
}
