<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rumah extends Model
{
    use HasFactory;

    protected $guarded = [
        '',
    ];

    protected $casts = [
        'foto_sebelum' => 'array',
        'foto_sesudah' => 'array',
    ];
}
