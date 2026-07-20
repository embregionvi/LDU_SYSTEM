<?php

namespace App\Controllers;

class LearningEventsConducted extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $data['events'] = $db->table('learning_events_conducted')
            ->orderBy('id', 'ASC')
            ->get()
            ->getResultArray();

        return view('learning_events_conducted/index', $data);
    }

    public function create()
    {
        return view('learning_events_conducted/create');
    }

    public function store()
    {
        $db = \Config\Database::connect();

        $data = $this->request->getPost();
        $data['total'] = ((int) ($data['male'] ?? 0)) + ((int) ($data['female'] ?? 0));

        $db->table('learning_events_conducted')->insert($data);

        return redirect()->to('/learning-events-conducted');
    }

    public function update($id)
    {
        $db = \Config\Database::connect();

        $data = $this->request->getPost();
        $data['total'] = ((int) ($data['male'] ?? 0)) + ((int) ($data['female'] ?? 0));

        $db->table('learning_events_conducted')
            ->where('id', $id)
            ->update($data);

        return redirect()->to('/learning-events-conducted');
    }

    public function delete($id)
    {
        $db = \Config\Database::connect();

        $db->table('learning_events_conducted')->delete(['id' => $id]);

        return redirect()->to('/learning-events-conducted');
    }
}