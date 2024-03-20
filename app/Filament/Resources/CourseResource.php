<?php

namespace App\Filament\Resources;

use App\Enum\CourseType;
use App\Filament\Resources\CourseResource\Pages;
use App\Filament\Resources\CourseResource\RelationManagers\ModuleSectionsRelationManager;
use App\Filament\Resources\CourseResource\RelationManagers\ModulesRelationManager;
use App\Filament\Resources\CourseResource\RelationManagers\TechnologiesRelationManager;
use App\Models\Course;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationGroup = 'Learning';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->lazy()
                    ->afterStateUpdated(function (?string $state, Forms\Set $set) {
                        $set('slug', Str::slug($state));
                    })
                    ->columnSpanFull()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->columnSpanFull()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->columnSpanFull()
                    ->maxLength(255),
                Forms\Components\Select::make('type')
                    ->required()
                    ->options(CourseType::options()),
                Forms\Components\DateTimePicker::make('published_at'),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->prefix('Rp'),
                Forms\Components\TextInput::make('discount')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_premium')
                    ->label('Premium course ?')
                    ->required()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('is_premium')
                    ->label('Premium course')
                    ->getStateUsing(fn(Course $record): string => $record->is_premium ? 'Yes' : 'No')
                    ->searchable(),
                Tables\Columns\TextColumn::make('modules_count')
                    ->label('Modules')
                    ->counts('modules')
                    ->searchable(),
                Tables\Columns\TextColumn::make('module_sections_count')
                    ->label('Sections')
                    ->counts('moduleSections')
                    ->searchable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make()
                    ->url(fn($record) => route("filament.my-course.pages.module", [
                        'course' => $record->slug,
                        'module' => $record->modules->first()->id
                    ]))
                    ->hidden(fn($record) => !$record->modules->count()),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                dd(auth('cms')->user());
                $query->when(
                    !auth('cms')->user()->isSuperAdmin(),
                    fn($query) => $query->where('is_premium', 0)
                );
            });
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCourses::route('/'),
            'edit' => Pages\EditCoursePage::route('/edit/{record}'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            ModuleSectionsRelationManager::class,
            ModulesRelationManager::class,
            TechnologiesRelationManager::class,
        ];
    }

}
