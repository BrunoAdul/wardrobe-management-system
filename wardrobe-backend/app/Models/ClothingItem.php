<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClothingItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'color',
        'size',
        'image',
        'category_id',
        'user_id'
    ];

    /**
     * Get the user that owns the clothing item.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that owns the clothing item.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Accessor for the image attribute.
     *
     * When the stored value is a relative path, this accessor returns a full URL.
     */
    public function getImageAttribute($value)
    {
        // If the value already starts with http(s), assume it's a full URL.
        if ($value && preg_match('/^https?:\/\//', $value)) {
            return $value;
        }
        return $value ? asset('storage/' . $value) : null;
    }
}
