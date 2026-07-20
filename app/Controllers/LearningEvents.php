<?php

namespace App\Controllers;

class LearningEvents extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $db = \Config\Database::connect();

        $data['events'] = $db->table('learning_events_attended')
            ->orderBy('id', 'DESC')
            ->get()
            ->getResultArray();

        return view('learning_events/index', $data);
    }

    public function create()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        return view('learning_events/create');
    }

    public function store()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $db = \Config\Database::connect();

        $male = (int) $this->request->getPost('male');
        $female = (int) $this->request->getPost('female');
        $total = $male + $female;

        $data = [
            'iis_no'                     => $this->request->getPost('iis_no'),
            'special_order_no'           => $this->request->getPost('special_order_no'),
            'title'                      => $this->request->getPost('title'),
            'provider'                   => $this->request->getPost('provider'),
            'competency'                 => $this->request->getPost('competency'),
            'type_learning'              => $this->request->getPost('type_learning'),
            'administrator'              => $this->request->getPost('administrator'),
            'office'                     => $this->request->getPost('office'),
            'date_from'                  => $this->request->getPost('date_from'),
            'date_to'                    => $this->request->getPost('date_to'),
            'cost'                       => $this->request->getPost('cost'),
            'training_hours'             => $this->request->getPost('training_hours'),
            'venue'                      => $this->request->getPost('venue'),
            'sponsor'                    => $this->request->getPost('sponsor'),
            'male'                       => $male,
            'female'                     => $female,
            'total'                      => $total,
            'attendance_sheets'          => $this->request->getPost('attendance_sheets'),
            'training_report_submission' => $this->request->getPost('training_report_submission'),
            'remarks'                    => $this->request->getPost('remarks'),
            'travel_expense'             => $this->request->getPost('travel_expense'),
        ];

        $db->table('learning_events_attended')->insert($data);

        return redirect()->to('/learning-events')->with('success', 'Learning event added successfully.');
    }

    public function edit($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $db = \Config\Database::connect();

        $event = $db->table('learning_events_attended')
            ->where('id', $id)
            ->get()
            ->getRowArray();

        if (!$event) {
            return redirect()->to('/learning-events')->with('error', 'Learning event not found.');
        }

        return view('learning_events/edit', ['event' => $event]);
    }

    public function update($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $db = \Config\Database::connect();

        $male = (int) $this->request->getPost('male');
        $female = (int) $this->request->getPost('female');
        $total = $male + $female;

        $data = [
            'iis_no'                     => $this->request->getPost('iis_no'),
            'special_order_no'           => $this->request->getPost('special_order_no'),
            'title'                      => $this->request->getPost('title'),
            'provider'                   => $this->request->getPost('provider'),
            'competency'                 => $this->request->getPost('competency'),
            'type_learning'              => $this->request->getPost('type_learning'),
            'administrator'              => $this->request->getPost('administrator'),
            'office'                     => $this->request->getPost('office'),
            'date_from'                  => $this->request->getPost('date_from'),
            'date_to'                    => $this->request->getPost('date_to'),
            'cost'                       => $this->request->getPost('cost'),
            'training_hours'             => $this->request->getPost('training_hours'),
            'venue'                      => $this->request->getPost('venue'),
            'sponsor'                    => $this->request->getPost('sponsor'),
            'male'                       => $male,
            'female'                     => $female,
            'total'                      => $total,
            'attendance_sheets'          => $this->request->getPost('attendance_sheets'),
            'training_report_submission' => $this->request->getPost('training_report_submission'),
            'remarks'                    => $this->request->getPost('remarks'),
            'travel_expense'             => $this->request->getPost('travel_expense'),
        ];

        $db->table('learning_events_attended')
            ->where('id', $id)
            ->update($data);

        return redirect()->to('/learning-events')->with('success', 'Learning event updated successfully.');
    }

    public function delete($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $db = \Config\Database::connect();

        $event = $db->table('learning_events_attended')
            ->where('id', $id)
            ->get()
            ->getRowArray();

        if (!$event) {
            return redirect()->to('/learning-events')->with('error', 'Learning event not found.');
        }

        $db->table('learning_events_attended')
            ->where('id', $id)
            ->delete();

        return redirect()->to('/learning-events')->with('success', 'Learning event deleted successfully.');
    }

    public function export()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $db = \Config\Database::connect();

        $data = $db->table('learning_events_attended')
            ->orderBy('id', 'DESC')
            ->get()
            ->getResultArray();

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename=learning_events_full.xls');

        echo "IIS No\tSpecial Order No\tTitle\tProvider\tCompetency\tType of Learning\tAdministrator\tOffice\tDate From\tDate To\tCost\tTraining Hours\tVenue\tSponsor\tMale\tFemale\tTotal\tAttendance Sheets\tTraining Report Submission\tRemarks\tTravel Expense\n";

        foreach ($data as $row) {
            echo ($row['iis_no'] ?? '') . "\t" .
                 ($row['special_order_no'] ?? '') . "\t" .
                 ($row['title'] ?? '') . "\t" .
                 ($row['provider'] ?? '') . "\t" .
                 ($row['competency'] ?? '') . "\t" .
                 ($row['type_learning'] ?? '') . "\t" .
                 ($row['administrator'] ?? '') . "\t" .
                 ($row['office'] ?? '') . "\t" .
                 ($row['date_from'] ?? '') . "\t" .
                 ($row['date_to'] ?? '') . "\t" .
                 ($row['cost'] ?? '') . "\t" .
                 ($row['training_hours'] ?? '') . "\t" .
                 ($row['venue'] ?? '') . "\t" .
                 ($row['sponsor'] ?? '') . "\t" .
                 ($row['male'] ?? '') . "\t" .
                 ($row['female'] ?? '') . "\t" .
                 ($row['total'] ?? '') . "\t" .
                 ($row['attendance_sheets'] ?? '') . "\t" .
                 ($row['training_report_submission'] ?? '') . "\t" .
                 ($row['remarks'] ?? '') . "\t" .
                 ($row['travel_expense'] ?? '') . "\n";
        }

        exit;
    }
}