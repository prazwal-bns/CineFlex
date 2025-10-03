<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Imports\UserImporter;
use App\Filament\Resources\UserResource;
use App\Filament\Resources\UserResource\Table\UserResourceTable;
use App\Models\User;
use Filament\Actions;
use Filament\Actions\ImportAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use STS\FilamentImpersonate\Tables\Actions\Impersonate;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->columns(UserResourceTable::getFields())
            ->filters([
                SelectFilter::make('id')
                    ->options(
                        User::query()
                            ->pluck('name', 'id')
                            ->toArray()
                    )
                    ->searchable()
                    ->label('Name'),

            ])
            ->recordActions([
                Impersonate::make()
                    ->icon('fluentui-person-sync-28-o')
                    ->color('secondary')
                    ->redirectTo(route('filament.admin.pages.dashboard'))
                    ->visible(function () {
                        return auth()->user()->isSuperAdmin();
                    }),
                Actions\ViewAction::make(),
                Actions\EditAction::make(),
            ])
            ->toolbarActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Add New User')
                ->icon('heroicon-s-user-plus'),

            Actions\ActionGroup::make([
                ImportAction::make('Import User')
                    ->modalHeading('Import User')
                    ->tooltip('Import New Users')
                    ->importer(UserImporter::class)
                    ->label('Import Users')
                    ->color('primary')
                    ->visible(function () {
                        return auth()->user()->isSuperAdmin();
                    }),
            ])->label('Imports Users')
                ->icon('heroicon-o-document-plus')
                ->button(),
        ];
    }
}
