<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Models\TrainingModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Events extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $db = \Config\Database::connect();

        $data['events'] = $db->table('events')
            ->select('events.*, trainings.title as training_title')
            ->join('trainings', 'trainings.id = events.training_id', 'left')
            ->orderBy('events.id', 'DESC')
            ->get()
            ->getResultArray();

        return view('events/index', $data);
    }

    public function create()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $empModel = new EmployeeModel();
        $trainingModel = new TrainingModel();

        $data['employees'] = $empModel->findAll();
        $data['trainings'] = $trainingModel->orderBy('title', 'ASC')->findAll();

        return view('events/create', $data);
    }

    public function store()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $db = \Config\Database::connect();

        $db->table('events')->insert([
            'training_id'       => $this->request->getPost('training_id') ?: null,
            'event_date'        => $this->request->getPost('event_date'),
            'iis_no'            => $this->request->getPost('iis_no'),
            'special_order_no'  => $this->request->getPost('special_order_no'),
            'title'             => $this->request->getPost('title'),
            'conducted_by'      => $this->request->getPost('conducted_by'),
            'venue'             => $this->request->getPost('venue'),
            'remarks'           => $this->request->getPost('remarks'),
        ]);

        $event_id = $db->insertID();

        $employee_ids = $this->request->getPost('employee_ids');

        if (!empty($employee_ids)) {
            foreach ($employee_ids as $emp_id) {
                $db->table('event_participants')->insert([
                    'event_id'    => $event_id,
                    'employee_id' => $emp_id
                ]);
            }
        }

        return redirect()->to('/events')->with('success', 'Event added successfully.');
    }

    public function edit($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $db = \Config\Database::connect();
        $empModel = new EmployeeModel();
        $trainingModel = new TrainingModel();

        $event = $db->table('events')
            ->where('id', $id)
            ->get()
            ->getRowArray();

        if (!$event) {
            throw PageNotFoundException::forPageNotFound('Event not found.');
        }

        $employees = $empModel->findAll();
        $trainings = $trainingModel->orderBy('title', 'ASC')->findAll();

        $participantRows = $db->table('event_participants')
            ->select('employee_id')
            ->where('event_id', $id)
            ->get()
            ->getResultArray();

        $selected_ids = array_column($participantRows, 'employee_id');

        return view('events/edit', [
            'event'        => $event,
            'employees'    => $employees,
            'trainings'    => $trainings,
            'selected_ids' => $selected_ids,
        ]);
    }

    public function update($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $db = \Config\Database::connect();

        $db->table('events')
            ->where('id', $id)
            ->update([
                'training_id'       => $this->request->getPost('training_id') ?: null,
                'event_date'        => $this->request->getPost('event_date'),
                'iis_no'            => $this->request->getPost('iis_no'),
                'special_order_no'  => $this->request->getPost('special_order_no'),
                'title'             => $this->request->getPost('title'),
                'conducted_by'      => $this->request->getPost('conducted_by'),
                'venue'             => $this->request->getPost('venue'),
                'remarks'           => $this->request->getPost('remarks'),
            ]);

        $db->table('event_participants')->where('event_id', $id)->delete();

        $employee_ids = $this->request->getPost('employee_ids');

        if (!empty($employee_ids)) {
            foreach ($employee_ids as $emp_id) {
                $db->table('event_participants')->insert([
                    'event_id'    => $id,
                    'employee_id' => $emp_id
                ]);
            }
        }

        return redirect()->to('/events')->with('success', 'Event updated successfully.');
    }

    public function delete($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $db = \Config\Database::connect();

        $db->table('event_participants')->where('event_id', $id)->delete();
        $db->table('events')->where('id', $id)->delete();

        return redirect()->to('/events')->with('success', 'Event deleted successfully.');
    }
}