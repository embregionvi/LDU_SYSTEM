<?php

namespace App\Models;

use CodeIgniter\Model;

class TrainingModel extends Model
{
    protected $table = 'trainings';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'employee_id',
        'title',
        'date_from',
        'date_to',
        'venue',
        'organizer',
        'special_order',
        'competency',
        'cpd_units',
        'ldu_budget',
        'created_at',
        'updated_at'
    ];
}