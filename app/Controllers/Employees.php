<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Employees extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $model = new EmployeeModel();
        $search = $this->request->getGet('search');

        if ($search) {
            $employees = $model
                ->groupStart()
                    ->like('employee_code', $search)
                    ->orLike('name', $search)
                    ->orLike('position', $search)
                    ->orLike('employment_type', $search)
                ->groupEnd()
                ->orderBy('id', 'DESC')
                ->findAll();
        } else {
            $employees = $model->orderBy('id', 'DESC')->findAll();
        }

        return view('employees/index', [
            'employees' => $employees,
            'search'    => $search
        ]);
    }

    public function create()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        return view('employees/create');
    }

    public function store()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $model = new EmployeeModel();

        $data = [
            'employee_code'   => $this->request->getPost('employee_code'),
            'name'            => $this->request->getPost('name'),
            'position'        => $this->request->getPost('position'),
            'employment_type' => $this->request->getPost('employment_type'),
        ];

        if (!$model->save($data)) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        return redirect()->to('/employees')->with('success', 'Employee added successfully.');
    }

    public function edit($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $model = new EmployeeModel();
        $employee = $model->find($id);

        if (!$employee) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('employees/edit', ['employee' => $employee]);
    }

    public function update($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $model = new EmployeeModel();

        $data = [
            'employee_code'   => $this->request->getPost('employee_code'),
            'name'            => $this->request->getPost('name'),
            'position'        => $this->request->getPost('position'),
            'employment_type' => $this->request->getPost('employment_type'),
        ];

        if (!$model->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        return redirect()->to('/employees')->with('success', 'Employee updated successfully.');
    }

    public function delete($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $model = new EmployeeModel();
        $model->delete($id);

        return redirect()->to('/employees')->with('success', 'Employee deleted successfully.');
    }

    public function trainings($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $db = \Config\Database::connect();
        $employeeModel = new EmployeeModel();

        $employee = $employeeModel->find($id);

        if (!$employee) {
            throw PageNotFoundException::forPageNotFound('Employee not found.');
        }

        // Employee trainings
        $trainings = $db->table('trainings')
            ->where('employee_id', $id)
            ->orderBy('date_from', 'DESC')
            ->get()
            ->getResultArray();

        // Employee attended events
        // Requires event_participants.event_id + employee_id
        // and events.training_id for modal matching
        $events = $db->table('events')
            ->select('events.*')
            ->join('event_participants', 'event_participants.event_id = events.id', 'inner')
            ->where('event_participants.employee_id', $id)
            ->orderBy('events.event_date', 'DESC')
            ->get()
            ->getResultArray();

        return view('employees/trainings', [
            'employee'  => $employee,
            'trainings' => $trainings,
            'events'    => $events,
        ]);
    }
}