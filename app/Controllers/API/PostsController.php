<?php

namespace App\Controllers\API;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\PostModel;

class PostsController extends ResourceController
{
    use ResponseTrait;
    private $post;

    public function __construct()
    {
        $this->post = new PostModel();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $posts = $this->post->findAll();
        return $this->respond($posts);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $post = $this->post->find($id);
        if($post) {
            return $this->respond($post);
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
        $validation = $this->validate($this->post->getValidationRules());
        if(!$validation) {
            return $this->failValidationErrors($this->validator->getErrors());
        }
        $post = $this->post->insert([
            'content' => $this->request->getVar('content'),
            'user_id' => $this->request->getVar('user_id'),
        ]);
        if($post) {
            return $this->respondCreated($this->post->find($post));
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
        $post = $this->post->find($id);
        if($post) {
            $validation = $this->validate($this->post->getValidationRules());

            if(!$validation) {
                return $this->failValidationErrors($this->validator->getErrors());
            }
            $post = [
                'id' => $id,
                'content' => $this->request->getRawInputVar('content'),
                'user_id' => $this->request->getRawInputVar('user_id'),
            ];
            $response = $this->post->save($post);
            if($response) {
                return $this->respondUpdated($post);
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
        $post = $this->post->find($id);
        if($post) {
            $response = $this->post->delete($id);
            if($response) {
                return $this->respondDeleted($post);
            }
            return $this->fail('Sorry! Failed to delete');
        }
        return $this->failNotFound('Sorry! Not found');
    }
}
