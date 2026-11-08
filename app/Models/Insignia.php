<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property int $group_id
 * @property string $path
 * @property int $requirement
 * @property-read Group $group
 */
class Insignia extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'group_id',
        'path',
        'requirement',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
}
