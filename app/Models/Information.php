<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use Notifiable;
    use Sortable;

    protected $table = 'information';

    public $sortable = [
        'id',
        'title',
        'text',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'text',
    ];
}
