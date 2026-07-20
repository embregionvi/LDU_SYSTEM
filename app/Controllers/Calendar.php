<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Calendar extends Controller
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $db = \Config\Database::connect();

        $rows = $db->table('calendar_events')
            ->orderBy('id', 'DESC')
            ->get()
            ->getResultArray();

        $calendarEvents = [];
        foreach ($rows as $row) {
            $calendarEvents[] = [
                'id' => $row['id'],
                'title' => $row['title'],
                'start' => $row['start_date'],
                'end' => $row['end_date'] ?: null,
                'allDay' => (bool) $row['all_day'],
                'backgroundColor' => $row['color'] ?: '#0d6efd',
                'borderColor' => $row['color'] ?: '#0d6efd',
                'textColor' => '#fff',
            ];
        }

        return view('calendar/index', [
            'calendarEvents' => $calendarEvents
        ]);
    }

    public function store()
    {
        $db = \Config\Database::connect();
        $data = $this->request->getJSON(true);

        $db->table('calendar_events')->insert([
            'title'      => $data['title'] ?? '',
            'start_date' => $data['start'] ?? null,
            'end_date'   => $data['end'] ?? null,
            'all_day'    => !empty($data['allDay']) ? 1 : 0,
            'color'      => $data['color'] ?? '#0d6efd',
        ]);

        return $this->response->setJSON([
            'success' => true,
            'id' => $db->insertID()
        ]);
    }

    public function update($id)
    {
        $db = \Config\Database::connect();
        $data = $this->request->getJSON(true);

        $db->table('calendar_events')
            ->where('id', $id)
            ->update([
                'title'      => $data['title'] ?? '',
                'start_date' => $data['start'] ?? null,
                'end_date'   => $data['end'] ?? null,
                'all_day'    => !empty($data['allDay']) ? 1 : 0,
                'color'      => $data['color'] ?? '#0d6efd',
            ]);

        return $this->response->setJSON([
            'success' => true
        ]);
    }

    public function delete($id)
    {
        $db = \Config\Database::connect();

        $db->table('calendar_events')
            ->where('id', $id)
            ->delete();

        return $this->response->setJSON([
            'success' => true
        ]);
    }
}