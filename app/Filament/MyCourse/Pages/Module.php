<?php

namespace App\Filament\MyCourse\Pages;

use App\Models\Module as Model;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Route;

class Module extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.my-course.pages.module';

    public Model $model;

    public function mount(): void
    {
        /** @var Model $model */
        $model       = Route::current()->parameter('module');
        $this->model = $model;
    }

    public function getHeading(): string|Htmlable
    {
        return ucwords($this->model->title);
    }

    public static function getRoutePath(): string
    {
        return '/{course}/modules/{module}';
    }

    public function getHeaderWidgets(): array
    {
        return [
            //            StatsOverview::class
        ];
    }
}
