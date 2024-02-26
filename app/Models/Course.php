<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'title',
        'type',
        'is_premium',
        'price',
        'discount',
        'description',
        'published_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'published_at' => 'datetime',
    ];

    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class, 'course_technologies');
    }

    public function admins(): BelongsToMany
    {
        return $this->belongsToMany(Admin::class, 'my_courses')
            ->withPivot([
                'is_completed',
                'completed_modules'
            ]);
    }

    public function moduleSections(): HasMany
    {
        return $this->hasMany(ModuleSection::class);
    }

    public function modules(): HasManyThrough
    {
        return $this->hasManyThrough(
            Module::class,
            ModuleSection::class
        );
    }
}
