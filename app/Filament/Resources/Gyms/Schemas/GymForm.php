<?php

namespace App\Filament\Resources\Gyms\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GymForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('owner_name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
            ]);
    }
}
