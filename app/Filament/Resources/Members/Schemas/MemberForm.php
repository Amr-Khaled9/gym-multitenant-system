<?php

namespace App\Filament\Resources\Members\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MemberForm
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
                Select::make('gym_id')
                    ->relationship('gym', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('trainer_id')
                    ->relationship('trainer', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }
}
