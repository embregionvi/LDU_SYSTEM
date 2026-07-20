<?php

namespace App\Controllers;

use App\Models\DocumentModel;
use App\Models\EmployeeModel;

class Documents extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $model = new DocumentModel();
        $search = $this->request->getGet('search');

        if ($search) {
            $documents = $model
                ->like('iis_tracking_no', $search)
                ->orLike('document_title', $search)
                ->orLike('received_from', $search)
                ->orLike('recent_remarks', $search)
                ->orLike('action_taken', $search)
                ->orLike('remarks', $search)
                ->orderBy('id', 'DESC')
                ->findAll();
        } else {
            $documents = $model->orderBy('id', 'DESC')->findAll();
        }

        return view('documents/index', [
            'documents' => $documents,
            'search'    => $search
        ]);
    }

    public function create()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $employeeModel = new EmployeeModel();
        $employees = $employeeModel->findAll();

        return view('documents/create', [
            'employees' => $employees
        ]);
    }

    public function store()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $model = new DocumentModel();

        $data = [
            'employee_id'           => $this->request->getPost('employee_id'),
            'iis_tracking_no'       => $this->request->getPost('iis_tracking_no'),
            'document_title'        => $this->request->getPost('title_of_document'),
            'date_received_office'  => $this->request->getPost('date_received_office'),
            'date_received_ldu'     => $this->request->getPost('date_received_ldu'),
            'received_from'         => $this->request->getPost('received_from'),
            'recent_remarks'        => $this->request->getPost('recent_remarks'),
            'action_taken'          => $this->request->getPost('action_taken'),
            'date_accomplished'     => $this->request->getPost('date_accomplished'),
            'remarks'               => $this->request->getPost('remarks'),
        ];

        if (!$model->save($data)) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        return redirect()->to('/documents')->with('success', 'Document added successfully.');
    }

    public function edit($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $model = new DocumentModel();
        $employeeModel = new EmployeeModel();

        $document = $model->find($id);

        if (!$document) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $employees = $employeeModel->findAll();

        return view('documents/edit', [
            'document'  => $document,
            'employees' => $employees
        ]);
    }

    public function update($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $model = new DocumentModel();

        $data = [
            'employee_id'           => $this->request->getPost('employee_id'),
            'iis_tracking_no'       => $this->request->getPost('iis_tracking_no'),
            'document_title'        => $this->request->getPost('title_of_document'),
            'date_received_office'  => $this->request->getPost('date_received_office'),
            'date_received_ldu'     => $this->request->getPost('date_received_ldu'),
            'received_from'         => $this->request->getPost('received_from'),
            'recent_remarks'        => $this->request->getPost('recent_remarks'),
            'action_taken'          => $this->request->getPost('action_taken'),
            'date_accomplished'     => $this->request->getPost('date_accomplished'),
            'remarks'               => $this->request->getPost('remarks'),
        ];

        if (!$model->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        return redirect()->to('/documents')->with('success', 'Document updated successfully.');
    }

    public function delete($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $model = new DocumentModel();
        $model->delete($id);

        return redirect()->to('/documents')->with('success', 'Document deleted successfully.');
    }
}