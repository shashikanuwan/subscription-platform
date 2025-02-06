<?php

namespace App\Models;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $title
 * @property string $description
 * @property int $website_id
 */
class Post extends Model
{
    /** @use HasFactory<PostFactory> */
    use HasFactory;

    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class);
    }
}
