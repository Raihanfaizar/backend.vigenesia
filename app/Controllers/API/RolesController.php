<?php

namespace App\Controllers\API;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\RoleModel;

class RolesController extends ResourceController
{
    use ResponseTrait;
    private $role;

    public function __construct()
    {
        $this->role = new RoleModel();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $roles = $this->role->findAll();
        return $this->respond($roles);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $role = $this->role->find($id);
        if($role) {
            return $this->respond($role);
        }
        return $this->failNotFound('Sorry! Not found');
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $validation = $this->validate($this->role->getValidationRules());
        if(!$validation) {
            return $this->failValidationErrors($this->validator->getErrors());
        }
        $role = $this->role->insert([
            'title' => $this->request->getVar('title'),
        ]);
        if($role) {
            return $this->respondCreated($this->role->find($role));
        }
        return $this->fail('Sorry! Failed to create');
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $role = $this->role->find($id);
        if($role) {
            $validation = $this->validate($this->role->getValidationRules());
            if(!$validation) {
                return $this->failValidationErrors($this->validator->getErrors());
            }
            $role = [
                'id' => $id,
                'title' => $this->request->getRawInputVar('title'),
            ];
            $response = $this->role->save($role);
            if($response) {
                return $this->respondUpdated($role);
            }
            return $this->fail('Sorry! Failed to update');
        }
        return $this-> failNotFound('Sorry! Not found');
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $role = $this->role->find($id);
        if($role) {
            $response = $this->role->delete($id);
            if($response) {
                return $this->respondDeleted($role);
            }
            return $this->fail('Sorry! Failed to delete');
        }
        return $this->failNotFound('Sorry! Not found');
    }
}