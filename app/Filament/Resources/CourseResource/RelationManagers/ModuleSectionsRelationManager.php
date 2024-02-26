<?php

namespace App\Filament\Resources\CourseResource\RelationManagers;

use App\Models\ModuleSection;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ModuleSectionsRelationManager extends RelationManager
{
    protected static string $relationship = 'moduleSections';

    public function form(Form $form): Form
    {
        return $form
            ->schema(ModuleSection::forms($this->getOwnerRecord()->id));
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('order'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(function (Builder $query, RelationManager $livewire): Builder {
                return $query
                    ->where('course_id', $livewire->getOwnerRecord()->id)
                    ->orderBy('order');
            });
    }
}
