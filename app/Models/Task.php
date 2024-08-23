<?php

namespace App\Models;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'description',
        'expiration',
        'priority',
        'status' ,

    ];
    protected $casts=[
        'status'=>TaskStatus::class,
        'priority'=>TaskPriority::class,
    ];

}
