<?php

namespace App\Controllers\API;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\CategoryModel;

class CategoriesController extends ResourceController
{
    use ResponseTrait;
    private $category;

    public function __construct()
    {
        $this->category = new CategoryModel();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $categories = $this->category->findAll();
        return $this->respond($categories);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $category = $this->category->find($id);
        if($category) {
            return $this->respond($category);
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
        $validation = $this->validate($this->category->getValidationRules());
        if(!$validation) {
            return $this->failValidationErrors($this->validator->getErrors());
        }
        $category = $this->category->insert([
            'title' => $this->request->getVar('title'),
        ]);
        if($category) {
            return $this->respondCreated($this->category->find($category));
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
        $category = $this->category->find($id);
        if($category) {
            $validation = $this->validate($this->category->getValidationRules());
            if(!$validation) {
                return $this->failValidationErrors($this->validator->getErrors());
            }
            $category = [
                'id' => $id,
                'title' => $this->request->getRawInputVar('title'),
            ];
            $response = $this->category->save($category);
            if($response) {
                return $this->respondUpdated($category);
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
        $category = $this->category->find($id);
        if($category) {
            $response = $this->category->delete($id);
            if($response) {
                return $this->respondDeleted($category);
            }
            return $this->fail('Sorry! Failed to delete');
        }
        return $this->failNotFound('Sorry! Not found');
    }
}
