<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDocument extends Model
{
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    // Use 'documents' table in the database to store multiple images.
    protected $fillable = [
        'document',
        'file'
    ];
    use HasFactory;
}
