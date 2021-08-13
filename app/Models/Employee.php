<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use Notifiable;
    use Sortable;

    protected $table = 'employees';

    public $sortable = [
        'id',
        'employee_id',
        'role',
        'department',
        'email'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id',
        'role',
        'department',
        'email'
    ];
}
