<?php

namespace App\Controllers;

use App\Models\TrainingModel;
use App\Models\EmployeeModel;
use App\Models\TrainingIlrModel;

class Trainings extends BaseController 
{
    public function index()
    {
        $db = \Config\Database::connect();

        $search = $this->request->getGet('search');
        $month  = $this->request->getGet('month');
        $year   = $this->request->getGet('year');

        $builder = $db->table('trainings');
        $builder->select('trainings.*, employees.name');
        $builder->join('employees', 'employees.id = trainings.employee_id', 'left');

        if ($search) {
            $builder->groupStart()
                ->like('employees.name', $search)
                ->orLike('trainings.title', $search)
                ->groupEnd();
        }

        if ($month) {
            $builder->where('MONTH(date_from)', $month);
        }

        if ($year) {
            $builder->where('YEAR(date_from)', $year);
        }

        $data['trainings'] = $builder->orderBy('trainings.id', 'DESC')->get()->getResultArray();
        $data['search'] = $search;
        $data['selectedMonth'] = $month;
        $data['selectedYear'] = $year;

        return view('trainings/index', $data);
    }

    public function create()
    {
        $empModel = new EmployeeModel();
        $data['employees'] = $empModel->findAll();

        return view('trainings/create', $data);
    }

    public function store()
    {
        $db = \Config\Database::connect();
        $model = new TrainingModel();

        $model->save([
            'title'         => $this->request->getPost('title'),
            'date_from'     => $this->request->getPost('date_from'),
            'date_to'       => $this->request->getPost('date_to'),
            'venue'         => $this->request->getPost('venue'),
            'organizer'     => $this->request->getPost('organizer'),
            'special_order' => $this->request->getPost('special_order'),
            'competency'    => $this->request->getPost('competency'),
            'cpd_units'     => $this->request->getPost('cpd_units'),
            'ldu_budget'    => $this->request->getPost('ldu_budget'),
        ]);

        $training_id = $model->getInsertID();
        $employee_ids = $this->request->getPost('employee_ids');

        if ($employee_ids) {
            foreach ($employee_ids as $emp_id) {
                $db->table('training_participants')->insert([
                    'training_id' => $training_id,
                    'employee_id' => $emp_id
                ]);
            }
        }

        return redirect()->to('/trainings');
    }

    public function export()
    {
        $db = \Config\Database::connect();

        $data = $db->table('trainings')
            ->select('trainings.*, employees.name')
            ->join('employees', 'employees.id = trainings.employee_id', 'left')
            ->get()
            ->getResultArray();

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=training_report.xls");

        echo "Employee\tTitle\tDate From\tDate To\tVenue\tOrganizer\tCPD\tBudget\n";

        foreach ($data as $row) {
            echo $row['name'] . "\t" .
                 $row['title'] . "\t" .
                 $row['date_from'] . "\t" .
                 $row['date_to'] . "\t" .
                 $row['venue'] . "\t" .
                 $row['organizer'] . "\t" .
                 $row['cpd_units'] . "\t" .
                 $row['ldu_budget'] . "\n";
        }

        exit;
    }

    public function report()
    {
        $db = \Config\Database::connect();

        $data['trainings'] = $db->table('trainings')
            ->select('trainings.*, employees.name')
            ->join('employees', 'employees.id = trainings.employee_id', 'left')
            ->get()
            ->getResultArray();

        return view('trainings/report', $data);
    }
public function cosDatabase()
{
    $db = \Config\Database::connect();

    $data['rows'] = $db->table('participants')
        ->select('
            participants.*,

            learning_events_attended.title,
            learning_events_attended.date_from,
            learning_events_attended.date_to,
            learning_events_attended.training_hours,
            learning_events_attended.special_order_no,
            learning_events_attended.venue,

            training_ilr.date_received,
            training_ilr.file_path
        ')
        ->join(
            'learning_events_attended',
            'learning_events_attended.id = participants.learning_event_id',
            'left'
        )
        ->join(
            'training_ilr',
            'training_ilr.participant_id = participants.id',
            'left'
        )
        ->orderBy('participants.id', 'DESC')
        ->get()
        ->getResultArray();

    // dropdown
    $data['learning_events'] = $db->table('learning_events_attended')->get()->getResultArray();

    return view('cos_database/index', $data);
}
    
public function saveIlr()
{
    
    $ilrModel = new \App\Models\TrainingIlrModel();

    $participantId = $this->request->getPost('id');

    if (!$participantId) {
        return redirect()->back()->with('error', 'Invalid participant ID');
    }
    

    $file = $this->request->getFile('ilr_file');
$filePath = null;

if ($file && $file->getError() !== 4) {

    if (!$file->isValid()) {
        return redirect()->back()->with('error', $file->getErrorString());
    }

    $participantName = preg_replace(
        '/[^a-zA-Z0-9]/',
        '_',
        $this->request->getPost('participant_name') ?: 'unknown'
    );

    $folder = FCPATH . 'uploads/ilr/' . $participantName;

    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    $originalName = $file->getClientName();

    $file->move($folder, $originalName);


    $filePath = 'uploads/ilr/' . $participantName . '/' . $originalName;
}
    //  PREPARE DATA
    $data = [
        'participant_id'     => $participantId,
        'date_submitted'     => $this->request->getPost('date_submitted'),
        'date_received'      => $this->request->getPost('date_received'),
        'transaction_number' => $this->request->getPost('transaction_number'),
        'subject_name'       => $this->request->getPost('subject_name'),
        'participant_name'   => $this->request->getPost('participant_name'),
        'date_from'          => $this->request->getPost('date_from'),
        'date_to'            => $this->request->getPost('date_to'),
        'venue'              => $this->request->getPost('venue'),
        'remarks'            => $this->request->getPost('remarks'),
    ];

    //  ONLY ADD FILE PATH IF FILE EXISTS
    if ($filePath !== null) {
        $data['file_path'] = $filePath;
    }

  
    $existing = $ilrModel
        ->where('participant_id', $participantId)
        ->first();

    if ($existing) {
        $ilrModel->update($existing['id'], $data);
    } else {
        $ilrModel->insert($data);
    }

    return redirect()->back()->with('success', 'ILR saved successfully');
}
    public function saveParticipant()
{
    $db = \Config\Database::connect();

    $learningEventId = $this->request->getPost('learning_event_id');
    $dateFrom = $this->request->getPost('date_from');

    // ILR Deadline (+14 days)
    $deadline = null;
    if (!empty($dateFrom)) {
        $deadline = date('Y-m-d', strtotime($dateFrom . ' +14 days'));
    }

    $db->table('participants')->insert([
        'learning_event_id' => $learningEventId,

        'last_name'   => $this->request->getPost('last_name'),
        'first_name'  => $this->request->getPost('first_name'),
        'middle_name' => $this->request->getPost('middle_name'),
        'position'    => $this->request->getPost('position'),

        // NULL ANAY KAY WALA PA VALUE
        'conducted_by' => $this->request->getPost('conducted_by') ?: null,
        'competency'   => $this->request->getPost('competency') ?: null,

        'ilr_deadline' => $deadline
    ]);

    return redirect()->back()->with('success', 'Participant added successfully');
}
}
