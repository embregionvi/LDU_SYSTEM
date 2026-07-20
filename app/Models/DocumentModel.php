<?php

namespace App\Models;

use CodeIgniter\Model;

class DocumentModel extends Model
{
    protected $table = 'documents';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'employee_id',
        'iis_tracking_no',
        'document_title',
        'date_received_office',
        'date_received_ldu',
        'received_from',
        'recent_remarks',
        'action_taken',
        'date_accomplished',
        'remarks',
    ];
}