<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Insignia extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'group_id',
        'path',
        'requirement',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
