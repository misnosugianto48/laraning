<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function courses(): HasMany
    {
        return parent::hasMany(Course::class, 'lecturer_id', 'id');
    }

    public function hasCourse(): BelongsToMany
    {
        return parent::belongsToMany(Course::class, 'course_student', 'student_id', 'course_id');
    }

    public function submissions(): HasMany
    {
        return parent::hasMany(Submission::class, 'student_id', 'id');
    }

    public function hasDiscussion(): HasMany
    {
        return parent::hasMany(Discussion::class, 'user_id', 'id');
    }

    public function hasReply(): HasMany
    {
        return parent::hasMany(Reply::class, 'user_id', 'id');
    }
}
