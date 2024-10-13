<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use App\Models\State;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Collection;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Schema;
use App\Filament\Resources\Get;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = "Employee Management";

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            // Section Relationship
            Forms\Components\Section::make('Relationship')
                ->description('Assign the appropriate relationships')
                ->schema([
                    Forms\Components\Select::make('country_id')
                        ->relationship(name: 'country', titleAttribute: 'name')
                        ->searchable()
                        ->preload()
                        ->live()
                        ->required(),
                    Forms\Components\TextInput::make('state_id')
                        ->options(fn (Get $get) :Collection => State::query()
                            ->where('country_id', $get->get('country_id'))
                            ->pluck('id', 'name'))
                        ->searchable()
                        ->preload()
                        ->required(),
                    Forms\Components\TextInput::make('city_id')
                    ->options(fn (Get $get) :Collection => State::query()
                    ->where('state_id', $get->get('state_id'))
                    ->pluck('id', 'name'))
                    ->searchable()
                        ->preload()
                        ->required(),
                    Forms\Components\TextInput::make('department_id')
                        ->label('Department ID')
                        ->required()
                        ->numeric(),
                ]),

            // Section User Name
            Forms\Components\Section::make('User Name')
                ->description('Put the user name details')
                ->schema([
                    Forms\Components\TextInput::make('first_name')
                        ->label('First Name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('last_name')
                        ->label('Last Name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('middle_name')
                        ->label('Middle Name')
                        ->maxLength(255)
                        ->default(null),
                ]),

            // Section User Address
            Forms\Components\Section::make('User Address')
                ->description('Provide the user\'s address details')
                ->schema([
                    Forms\Components\TextInput::make('address')
                        ->label('Address')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('zip_code')
                        ->label('ZIP Code')
                        ->required()
                        ->maxLength(255),
                ]),

            // Additional Fields
            Forms\Components\DatePicker::make('date_of_birth')
                ->label('Date of Birth')
                ->required(),
            Forms\Components\DatePicker::make('date_hired')
                ->label('Date Hired')
                ->required()
                ->columnSpanFull(),
        ])->columns(3);
}


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('country_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('state_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('city_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('department_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('middle_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('zip_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_hired')
                    ->searchable(),
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'view' => Pages\ViewEmployee::route('/{record}'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
