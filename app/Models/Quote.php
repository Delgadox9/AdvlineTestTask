<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Tag;

class Quote extends Model
{
    /** @use HasFactory<\Database\Factories\QuoteFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'text'
    ];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'quotes_tags', 'quote_id', 'tag_id');
    }
}
