<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;

    protected $table = 'tags';

    protected $fillable = [
        'name',
    ];

    public function quotes(): BelongsToMany
    {
        return $this->belongsToMany(Quote::class, 'quotes_tags', 'tag_id', 'quote_id');
    }
}
