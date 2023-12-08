<?php

namespace App\Controllers\API;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ReportModel;

class ReportsController extends ResourceController
{
    use ResponseTrait;
    private $report;

    public function __construct()
    {
        $this->report = new ReportModel();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $reports = $this->report->findAll();
        return $this->respond($reports);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $report = $this->report->find($id);
        if($report) {
            return $this->respond($report);
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
        $validation = $this->validate($this->report->getValidationRules());
        if(!$validation) {
            return $this->failValidationErrors($this->validator->getErrors());
        }
        $report = $this->report->insert([
            'title' => $this->request->getVar('title'),
        ]);
        if($report) {
            return $this->respondCreated($this->report->find($report));
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
        $report = $this->report->find($id);
        if($report) {
            $validation = $this->validate($this->report->getValidationRules());
            if(!$validation) {
                return $this->failValidationErrors($this->validator->getErrors());
            }
            $report = [
                'id' => $id,
                'title' => $this->request->getRawInputVar('title'),
            ];
            $response = $this->report->save($report);
            if($response) {
                return $this->respondUpdated($report);
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
        $report = $this->report->find($id);
        if($report) {
            $response = $this->report->delete($id);
            if($response) {
                return $this->respondDeleted($report);
            }
            return $this->fail('Sorry! Failed to delete');
        }
        return $this->failNotFound('Sorry! Not found');
    }
}