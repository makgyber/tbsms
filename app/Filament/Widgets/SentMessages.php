<?php

namespace App\Filament\Widgets;

use App\Models\Sent;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class SentMessages extends BaseWidget
{
    protected function getTableQuery(): Builder
    {
        return Sent::query();
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
