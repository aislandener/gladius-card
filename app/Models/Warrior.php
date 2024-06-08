<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warrior extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'photo',
        'xp',
        'hp',
        'is_leader',
        'clan_id',
    ];

    public function clan(): BelongsTo
    {
        return $this->belongsTo(Clan::class);
    }
}
