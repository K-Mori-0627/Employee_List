<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use Notifiable;
    use Sortable;

    protected $table = 'members';

    public $sortable = [
        'id',
        'member_id',
        'role',
        'department'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'member_id',
        'role',
        'department'
    ];
}
