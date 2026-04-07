<?php

namespace App\Filament\Resources\Subscriptions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SubscriptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('member_id')
                    ->relationship('member', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('plan')
                    ->required(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                DatePicker::make('start_date')
                    ->required(),
                DatePicker::make('end_date')
                    ->required(),
                Select::make('status')
                    ->options(['active' => 'Active', 'expired' => 'Expired', 'cancelled' => 'Cancelled'])
                    ->default('active')
                    ->required(),
                Select::make('gym_id')
                    ->relationship('gym', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }
}
