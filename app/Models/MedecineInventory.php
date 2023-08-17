<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedecineInventory extends Model
{
    use HasFactory;
    protected $fillable = [
        'medecine_name',
        'qty',
        'status_id',
    ];
}
