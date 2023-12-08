<?php

namespace App\Controllers\API;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use Firebase\JWT\JWT;

class UsersController extends ResourceController
{
    use ResponseTrait;
    private $user;

    public function __construct()
    {
        $this->user = new UserModel();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $users = $this->user->findAll();
        return $this->respond($users);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $user = $this->user->find($id);
        if($user) {
            return $this->respond($user);
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
        $validation = $this->validate($this->user->getValidationRules());
        if(!$validation) {
            return $this->failValidationErrors($this->validator->getErrors());
        }
        $user = $this->user->insert([
            'name' => $this->request->getVar('name'),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
        ]);
        if($user) {
            return $this->respondCreated($this->user->find($user));
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
        $user = $this->user->find($id);
        if($user) {
            $validation = $this->validate($this->user->getValidationRules());
            if(!$validation) {
                return $this->failValidationErrors($this->validator->getErrors());
            }
            $user = [
                'id' => $id,
                'name' => $this->request->getRawInputVar('name'),
                'username' => $this->request->getRawInputVar('username'),
                'email' => $this->request->getRawInputVar('email'),
                'password' => $this->request->getRawInputVar('password'),
            ];
            $response = $this->user->save($user);
            if($response) {
                return $this->respondUpdated($user);
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
        $user = $this->user->find($id);
        if($user) {
            $response = $this->user->delete($id);
            if($response) {
                return $this->respondDeleted($user);
            }
            return $this->fail('Sorry! Failed to delete');
        }
        return $this->failNotFound('Sorry! Not found');
    }
    
    /**
     * Login to get a token, from "posted" properties
     *
     * @return mixed
     */
    public function login() {
        if (!$this->validate([
            'email'     => 'required|max_length[32]|valid_email',
            'password'  => 'required|max_length[256]',
        ])) {
            return $this->failValidationErrors($this->validator->getErrors());
        }
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $user = $this->user->allowCallbacks(false)->where('email', $email)->first();
        if(is_null($user)) {
            return $this->fail(['email' => 'Sorry! Email not found'], 404);
        }
        $pwd_verify = password_verify($password, $user['password']);
        if(!$pwd_verify) {
            return $this->fail(['password' => 'Sorry! Wrong password'], 401);
        }
        unset($user["password"]);
        $key = getenv('JWT_SECRET');
        $iat = time();
        $exp = $iat + 3600;
        $payload = [
            'iat' => $iat,
            'exp' => $exp,
            'user_id' => $user['id'],
        ];
        $token = JWT::encode($payload, $key, 'HS256');
        $response = [
            'message' => 'Login Successful',
            'user_id' => $user['id'],
            'token' => $token
        ];
        return $this->respond($response, 200);
    }
}
