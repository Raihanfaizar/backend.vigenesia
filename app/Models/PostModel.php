<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\UserModel;
use App\Models\CategoryModel;

class PostModel extends Model
{
    protected $table            = 'posts';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'content',
        'user_id',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'content' => 'required|max_length[256]',
        'user_id' => 'required|max_length[11]',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = ['getRelation'];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected function getRelation(array $data) {
        $user = new UserModel();
        $category = new CategoryModel();

        if ($data['method'] == 'first' || ($data['method'] == 'find' && $data['data']['id'])) {
            $data['data']['user'] = $user->find($data['data']['user_id']);
            $data['data']['category'] = $category->find($data['data']['category_id']);
            unset($data['data']['user']['email']);
            unset($data['data']['user']['password']);
            unset($data['data']['user']['role_id']);
            unset($data['data']['user']['created_at']);
            unset($data['data']['user']['updated_at']);
            unset($data['data']['user_id']);
            unset($data['data']['category_id']);
            return $data;
        }
        foreach ($data['data'] as $key => $post) {
            $data['data'][$key]['user'] = $user->find($data['data'][$key]['user_id']);
            $data['data'][$key]['category'] = $category->find($data['data'][$key]['category_id']);
            unset($data['data'][$key]['user']['email']);
            unset($data['data'][$key]['user']['password']);
            unset($data['data'][$key]['user']['role_id']);
            unset($data['data'][$key]['user']['created_at']);
            unset($data['data'][$key]['user']['updated_at']);
            unset($data['data'][$key]['user_id']);
            unset($data['data'][$key]['category_id']);
        }
        return $data;
    }
}
