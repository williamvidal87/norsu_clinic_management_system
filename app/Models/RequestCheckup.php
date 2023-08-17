<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestCheckup extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'purpose',
        'schedule',
        'status_id',
        'remarks',
        'walkin_date',
    ];

    public function getStatus()
    {
        return $this->belongsTo(Status::class,'status_id');
    }

    public function getUser()
    {
        return $this->belongsTo(User::class,'patient_id')->with('getDeptID');
    }


}
