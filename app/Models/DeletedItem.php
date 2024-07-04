<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeletedItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'marvel_id',
        'title',
        'times_deleted',
    ];

    protected $casts = [
        'marvel_id' => 'integer',
        'title' => 'string',
        'times_deleted' => 'integer',
    ];
}
