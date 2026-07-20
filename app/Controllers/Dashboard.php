<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $db = \Config\Database::connect();

        $selectedMonth = (int) ($this->request->getGet('month') ?: date('n'));
        $selectedYear  = (int) ($this->request->getGet('year') ?: date('Y'));

        $data['selectedMonth'] = $selectedMonth;
        $data['selectedYear']  = $selectedYear;

        $data['totalEmployees'] = $db->table('employees')->countAll();
        $data['totalTrainings'] = $db->table('trainings')->countAll();
        $data['totalEvents'] = $db->table('events')->countAll();
        $data['totalDocuments'] = $db->table('documents')->countAll();

        if ($db->tableExists('learning_events')) {
            $data['totalLearningEvents'] = $db->table('learning_events')->countAll();

            $data['recentLearningEvents'] = $db->table('learning_events le')
                ->select('le.*, employees.name as employee_name')
                ->join('employees', 'employees.id = le.employee_id', 'left')
                ->orderBy('le.id', 'DESC')
                ->limit(5)
                ->get()
                ->getResultArray();
        } else {
            $data['totalLearningEvents'] = 0;
            $data['recentLearningEvents'] = [];
        }

        $data['pendingDocuments'] = $db->table('documents')
            ->groupStart()
                ->where('remarks', 'pending')
                ->orWhere('status', 'pending')
            ->groupEnd()
            ->countAllResults();

        $data['recentTrainings'] = $db->table('trainings t')
            ->select('t.*, employees.name')
            ->join('employees', 'employees.id = t.employee_id', 'left')
            ->orderBy('t.id', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();

        $data['recentEvents'] = $db->table('events')
            ->orderBy('id', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();

        $data['recentDocuments'] = $db->table('documents')
            ->select('documents.*, employees.name as employee_name')
            ->join('employees', 'employees.id = documents.employee_id', 'left')
            ->orderBy('documents.id', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();

        $startDate = sprintf('%04d-%02d-01', $selectedYear, $selectedMonth);
        $endDate   = date('Y-m-t', strtotime($startDate));

        $calendarEvents = $db->table('events')
            ->where('event_date >=', $startDate)
            ->where('event_date <=', $endDate)
            ->orderBy('event_date', 'ASC')
            ->get()
            ->getResultArray();

        $eventsByDate = [];
        foreach ($calendarEvents as $event) {
            $date = $event['event_date'] ?? null;
            if ($date) {
                $eventsByDate[$date][] = $event;
            }
        }

        $data['eventsByDate'] = $eventsByDate;

        if ($db->tableExists('employee_reports')) {
            $data['reports'] = $db->table('employee_reports er')
                ->select('er.*, employees.name as employee_name')
                ->join('employees', 'employees.id = er.employee_id', 'left')
                ->orderBy('er.id', 'DESC')
                ->limit(10)
                ->get()
                ->getResultArray();

            $data['unreadReports'] = $db->table('employee_reports')
                ->where('is_read', 0)
                ->countAllResults();
        } else {
            $data['reports'] = [];
            $data['unreadReports'] = 0;
        }

        $data['employees'] = $db->table('employees')
            ->orderBy('name', 'ASC')
            ->get()
            ->getResultArray();

        return view('dashboard', $data);
    }

    public function storeCalendarEvent()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $db = \Config\Database::connect();

        $db->table('events')->insert([
            'event_date'       => $this->request->getPost('event_date'),
            'iis_no'           => $this->request->getPost('iis_no'),
            'special_order_no' => $this->request->getPost('special_order_no'),
            'title'            => $this->request->getPost('title'),
            'conducted_by'     => $this->request->getPost('conducted_by'),
            'venue'            => $this->request->getPost('venue'),
            'remarks'          => $this->request->getPost('remarks'),
        ]);

        return redirect()->to('/dashboard?tab=calendar')->with('success', 'Schedule added successfully.');
    }

    public function storeReport()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $db = \Config\Database::connect();

        if ($db->tableExists('employee_reports')) {
            $db->table('employee_reports')->insert([
                'employee_id' => $this->request->getPost('employee_id'),
                'subject'     => $this->request->getPost('subject'),
                'message'     => $this->request->getPost('message'),
                'is_read'     => 0,
                'created_at'  => date('Y-m-d H:i:s'),
            ]);
        }

        return redirect()->to('/dashboard?tab=messages')->with('success', 'Report submitted successfully.');
    }

    public function notificationsList()
    {
        if (!session()->get('logged_in')) {
            return $this->response->setStatusCode(401)->setJSON([
                'success' => false
            ]);
        }

        $db = \Config\Database::connect();

        if (!$db->tableExists('employee_reports')) {
            return $this->response->setJSON([
                'success' => true,
                'unread_count' => 0,
                'items' => []
            ]);
        }

        $unreadCount = $db->table('employee_reports')
            ->where('is_read', 0)
            ->countAllResults();

        $items = $db->table('employee_reports er')
            ->select('er.*, employees.name as employee_name')
            ->join('employees', 'employees.id = er.employee_id', 'left')
            ->orderBy('er.id', 'DESC')
            ->limit(8)
            ->get()
            ->getResultArray();

        return $this->response->setJSON([
            'success' => true,
            'unread_count' => $unreadCount,
            'items' => $items
        ]);
    }

    public function markNotificationRead($id)
    {
        if (!session()->get('logged_in')) {
            return $this->response->setStatusCode(401)->setJSON([
                'success' => false
            ]);
        }

        $db = \Config\Database::connect();

        if ($db->tableExists('employee_reports')) {
            $db->table('employee_reports')
                ->where('id', $id)
                ->update(['is_read' => 1]);
        }

        return $this->response->setJSON([
            'success' => true
        ]);
    }

    public function markAllNotificationsRead()
    {
        if (!session()->get('logged_in')) {
            return $this->response->setStatusCode(401)->setJSON([
                'success' => false
            ]);
        }

        $db = \Config\Database::connect();

        if ($db->tableExists('employee_reports')) {
            $db->table('employee_reports')
                ->where('is_read', 0)
                ->update(['is_read' => 1]);
        }

        return $this->response->setJSON([
            'success' => true
        ]);
    }
}