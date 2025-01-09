<?php

namespace App\Filament\Resources;

use App\Enums\UserRoles;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $modelLabel = 'Utilisateur';

    protected static ?string $model = User::class;

    protected static ?string $navigationLabel = 'Liste';

    protected static ?string $navigationGroup = 'Utilisateurs';

    protected static ?int $navigationSort = 20;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('nom')->required(),
                TextInput::make('email')
                    ->unique(ignoreRecord: true)
                    ->required(),

                // Mot de passe non obligatoire en cas de mise à jour
                TextInput::make('password')
                    ->password()
                    ->afterStateHydrated(function (TextInput $component) {
                        $component->state('');
                    })
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create')
                    ->autocomplete('new-password') // "new-XXX" force chrome à ne pas autocompléter le champ
                    ->revealable(),
                Select::make('role')->label('Rôle')->options(fn () => getAllEnumValues(UserRoles::cases())),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nom')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('role')->label('Rôle'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
