<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserGroup extends Model
{
    use HasFactory;

    protected $table = 'user_group'; // because model name differs from table

    protected $primaryKey = 'id';

    public $timestamps = false; 
    // set false because your table uses created_dt_tm & updated_dt_tm

    protected $fillable = [
        'group_name',
        'modules',
        'created_dt_tm',
        'updated_dt_tm',
        'is_active',
        'created_by',
        'updated_by', 
    ];
}
