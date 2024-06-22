<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected function logoXp(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => Insignia::whereRelation('group', 'field', 'xp')
                ->where('requirement', '<=', $this->xp)
                ->orderBy('requirement', 'desc')
                ->first()
                ?->path,
        );
    }

    protected function logoHp(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) => Insignia::whereRelation('group', 'field', 'hp')
                ->where('requirement', '<=', $this->hp)
                ->orderBy('requirement', 'desc')
                ->first()
                ?->path,
        );
    }

    protected function logoLeader(): Attribute
    {
        return Attribute::make(
            get: fn($value, array $attributes) =>  $this->is_leader ? Insignia::where('name', 'Mestre Fundador')
                ->first()
                ?->path : null,
        );
    }

    public function clan(): BelongsTo
    {
        return $this->belongsTo(Clan::class);
    }
}
