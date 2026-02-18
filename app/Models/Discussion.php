<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discussion extends Model
{
    /** @use HasFactory<\Database\Factories\DiscussionFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'course_id',
        'user_id',
        'content'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    public function replies(): HasMany
    {
        return parent::hasMany(Reply::class, 'discussion_id', 'id');
    }

    public function course(): BelongsTo
    {
        return parent::belongsTo(Course::class, 'course_id', 'id');
    }

    public function user(): BelongsTo
    {
        return parent::belongsTo(User::class, 'user_id', 'id');
    }
}
