<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use Sortable;

    protected $table = 'users';

    public $sortable = [
        'id',
        'name_kana',
        'name_roma',
        'employee_id',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_kana',
        'name_roma',
        'employee_id',
        'login_id',
        'password',
        'profile_img',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
