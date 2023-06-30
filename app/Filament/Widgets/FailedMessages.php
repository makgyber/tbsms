<?php

namespace App\Filament\Widgets;

use App\Models\Failed;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class FailedMessages extends BaseWidget
{
    protected function getTableQuery(): Builder
    {
        return Failed::query();
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

    protected function getTableBulkActions(): array
    {
        return [
            BulkAction::make('retry')
                ->action(function ($records) {
                    $path = config('smsd.failed') . '/';
                    $target = config('smsd.received') . '/';
                    foreach ($records as $record) {
                        rename($path . $record['file'], $target . $record['file']);
                    }
                }),
            BulkAction::make('delete')
                ->action(function ($records) {
                    $path = config('smsd.failed') . '/';
                    foreach ($records as $record) {
                        unlink($path . $record['file']);
                    }
                })
        ];
    }

    protected function getTableActions(): array
    {
        return [
            DeleteAction::make('delete')
                ->action(function ($record) {
                    $path = config('smsd.failed') . '/';
                    unlink($path . $record['file']);
                }),
            Action::make('retry')
                ->icon('heroicon-o-arrow-up')
                ->action(function ($record) {
                    $path = config('smsd.failed') . '/';
                    $target = config('smsd.received') . '/';
                    rename($path . $record['file'], $target . $record['file']);
                })
        ];
    }
}
