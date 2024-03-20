<?php

namespace App\Filament\Resources\CourseResource\RelationManagers;

use App\Models\ModuleSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Table;

class ModulesRelationManager extends RelationManager
{
    protected static string $relationship = 'modules';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('module_section_id')
                    ->label('Module Section')
                    ->relationship(name: 'moduleSection', titleAttribute: 'title', modifyQueryUsing: function ($query, RelationManager $livewire) {
                        return $query
                            ->where('course_id', $livewire->getOwnerRecord()->id)
                            ->orderBy('order');
                    })
//                    ->manageOptionForm(ModuleSection::forms())
//                    ->createOptionUsing(function (array $data, RelationManager $livewire) {
//                        return ModuleSection::query()->create([
//                            ...$data,
//                            ...['course_id' => $livewire->getOwnerRecord()->id],
//                        ])->id;
//                    })
//                    ->updateOptionUsing(function (array $data, Forms\Components\Select $component) {
//                        return $component->getModelInstance()->{$component->getRelationship()->getRelationName()}
//                            ->update($data);
//                    })
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('order')
                    ->numeric()
                    ->default(0)
                    ->required(),
                Forms\Components\MarkdownEditor::make('content')
                    ->columnSpanFull()
                    ->maxLength(65535)
                    ->required()
                    ->fileAttachmentsDisk(config('media-library.disk_name'))
                    ->toolbarButtons([
                        'side-by-side',
                        'preview',
                        'guide',
                        'fullscreen',
                        'attachFiles',
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'heading',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'table',
                        'undo',
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('moduleSection.title'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('order'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\Action::make('create-module-section')
                    ->color(Color::Lime)
                    ->label('New Module Section')
                    ->form(fn (RelationManager $livewire) => ModuleSection::forms($livewire->getOwnerRecord()->id))
                    ->mutateFormDataUsing(function (array $data, RelationManager $livewire) {
                        return ModuleSection::query()->create([
                            ...$data,
                            ...['course_id' => $livewire->getOwnerRecord()->id],
                        ])->toArray();
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
