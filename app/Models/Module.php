<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Module extends Model
{
     use HasFactory, Notifiable;
     public $timestamps = false;
    protected $fillable = [
        'module_group',
        'modules_name',
        'module_url',
        'module_order',
        'panel_type',
    ];
}
