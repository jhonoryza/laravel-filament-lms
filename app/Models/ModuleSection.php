<?php

namespace App\Models;

use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Validation\Rules\Unique;

class ModuleSection extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'order',
        'course_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'course_id' => 'integer',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function modules(): HasMany
    {
        return $this->hasMany(Module::class);
    }

    public static function forms(int $courseId): array
    {
        return [
            TextInput::make('title')
                ->unique(table: 'module_sections', column: 'title', ignoreRecord: true, modifyRuleUsing: function (Unique $rule) use ($courseId) {
                    return $rule->where('course_id', $courseId);
                })
                ->required()
                ->maxLength(255),
            TextInput::make('order')
                ->numeric()
                ->default(0)
                ->required()
        ];
    }
}
