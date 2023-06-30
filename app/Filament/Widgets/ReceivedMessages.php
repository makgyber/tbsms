<?php

namespace App\Filament\Widgets;

use App\Models\Received;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class ReceivedMessages extends BaseWidget
{
    protected function getTableQuery(): Builder
    {
        return Received::query();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('file'),
            TextColumn::make('mobile'),
            TextColumn::make('message')
        ];
    }

    protected function getTablePollingInterval(): ?string
    {
        return '5s';
    }
}
