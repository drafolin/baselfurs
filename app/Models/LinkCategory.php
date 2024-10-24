<?php

namespace App\Models;

use Filament\Tables\Concerns\CanReorderRecords;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LinkCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "position"
    ];

    public function links(): HasMany {
        return $this->hasMany(Link::class);
    }
}
