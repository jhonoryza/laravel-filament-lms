<?php

namespace App\Providers\Filament;

use App\Filament\MyCourse\Pages\Module;
use App\Models\ModuleSection;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Http\Request;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class MyCoursePanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('my-course')
            ->path('my-course')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->login()
            ->authGuard('cms')
            ->authPasswordBroker('cms')
            ->discoverResources(in: app_path('Filament/MyCourse/Resources'), for: 'App\\Filament\\MyCourse\\Resources')
            ->discoverPages(in: app_path('Filament/MyCourse/Pages'), for: 'App\\Filament\\MyCourse\\Pages')
            ->discoverWidgets(in: app_path('Filament/MyCourse/Widgets'), for: 'App\\Filament\\MyCourse\\Widgets')
            ->pages([
                Module::class
            ])
            ->navigation(function (NavigationBuilder $builder, Request $request): NavigationBuilder {
                $courseSlug = $request->route()->parameter('course');
                $moduleSections = ModuleSection::query()
                    ->whereHas('course', fn ($query) => $query->where('slug', $courseSlug))
                    ->get();

                $navs = [];

                $navMyCourse = NavigationItem::make('Back')
                            ->url(route('filament.account.resources.courses.index'));

                foreach ($moduleSections as $moduleSection) {
                    $nav = NavigationGroup::make($moduleSection->title)
                            ->label(ucwords($moduleSection->title))
                            ->icon('heroicon-o-document-text')
                            ->items(
                                $moduleSection->modules->map(function ($item) use ($courseSlug) {
                                    return NavigationItem::make($item->title)
                                        ->label(ucwords($item->title))
                                        ->url(route("filament.my-course.pages.module", [
                                            'course' => $courseSlug,
                                            'module' => $item->id
                                        ]));
                                })->toArray()
                            );
                    $navs[] = $nav;
                }

                return $builder
                    ->item($navMyCourse)
                    ->groups($navs);
            })
            ->viteTheme('resources/css/filament/my-course/theme.css')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
