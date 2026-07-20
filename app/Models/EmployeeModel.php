<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table            = 'employees';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields = [
        'employee_code',
        'name',
        'position',
        'employment_type'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';

    protected $validationRules = [
        'id'              => 'permit_empty|integer',
        'employee_code'   => 'required|is_unique[employees.employee_code,id,{id}]',
        'name'            => 'required',
        'position'        => 'required',
        'employment_type' => 'required'
    ];

    protected $validationMessages = [
        'employee_code' => [
            'required'  => 'Employee Code is required',
            'is_unique' => 'Employee Code already exists'
        ],
        'name' => [
            'required' => 'Name is required'
        ],
        'position' => [
            'required' => 'Position is required'
        ],
        'employment_type' => [
            'required' => 'Employment type is required'
        ]
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}