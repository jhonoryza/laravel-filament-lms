<?php

namespace App\Models;

use Fajar\Filament\Suitcms\Models\Admin as BaseAdmin;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Admin extends BaseAdmin
{
    const SUPERADMIN = 'superadmin';
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'my_courses')
            ->withPivot([
                'is_completed',
                'completed_modules'
            ]);
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole([self::SUPERADMIN]);
    }
}
