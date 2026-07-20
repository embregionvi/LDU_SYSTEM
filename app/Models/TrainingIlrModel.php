<?php
namespace App\Models;

use CodeIgniter\Model;

class TrainingIlrModel extends Model
{
    protected $table = 'training_ilr';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'training_id',
        'date_submitted',
        'transaction_number',
        'subject_name',
        'participant_name',
        'date_from',
        'date_to',
        'venue',
        'remarks',
        'date_received',
        'file_path',
        'participant_id'
    ];

    protected $useTimestamps = true;
}
?>