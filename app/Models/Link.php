<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "url",
        "link_category_id"
    ];

    public function linkCategory(): BelongsTo
    {
        return $this->belongsTo(LinkCategory::class);
    }
}
