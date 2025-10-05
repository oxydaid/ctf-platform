<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Challenge;
use Filament\Tables\Table;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ChallengeResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ChallengeResource\RelationManagers;

class ChallengeResource extends Resource
{
    protected static ?string $model = Challenge::class;

    protected static ?string $navigationGroup = 'CTF';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-cube';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Challenge Details')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('short_description')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\RichEditor::make('description')
                            ->required()
                            ->fileAttachmentsDirectory('challenges'),
                        Forms\Components\Select::make('user_id')
                            ->label('Pembuat Soal (Author)')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->helperText('Hanya Super Admin yang bisa mengubah pembuat soal.'),
                    ])->columnSpan(2),
                Section::make('Challenge Settings')
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->label('Category')
                            ->relationship('category', 'name')
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('difficulty')
                            ->options([
                                'easy' => 'Easy',
                                'medium' => 'Medium',
                                'hard' => 'Hard',
                                'insane' => 'insane',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('points')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('flag')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Toggle::make('is_active')
                            ->required(),
                    ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('short_description')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('points')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Author')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('flag')
                    ->searchable()
                    ->limit(20),
                Tables\Columns\TextColumn::make('difficulty')
                    ->sortable()
                    ->badge()->color(fn(string $state): string => match ($state) {
                        'easy' => 'info',
                        'medium' => 'success',
                        'hard' => 'warning',
                        'insane' => 'danger',
                    }),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
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
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChallenges::route('/'),
            'create' => Pages\CreateChallenge::route('/create'),
            'edit' => Pages\EditChallenge::route('/{record}/edit'),
        ];
    }
}
