<?php

namespace App\Filament\Resources\Trainers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TrainerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->default(null),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                TextInput::make('specialization')
                    ->default(null),
                TextInput::make('salary')
                    ->numeric()
                    ->default(null),
                Select::make('gym_id')
                    ->relationship('gym','name')
                    ->searchable()
                    ->preload()
                    ->required()
            ]);
    }
}
