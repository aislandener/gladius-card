<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clan extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'color',
        'is_default',
    ];

    protected function casts()
    {
        return [
            'is_default' => 'bool'
        ];
    }
}
