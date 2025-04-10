<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Imports\UserImporter;
use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Filament\Resources\UserResource\Table\UserResourceTable;
use App\Models\User;
use Filament\Actions\ImportAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
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
            ->actions([
                Impersonate::make()
                    ->icon('fluentui-person-sync-28-o')
                    ->color('secondary')
                    ->redirectTo(route('filament.admin.pages.dashboard')),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Add New User')
                ->icon('heroicon-s-user-plus'),

                Tables\Actions\ActionGroup::make([
                    ImportAction::make('Import User')
                    ->modalHeading('Import User')
                    ->tooltip('Import New Users')
                    ->importer(UserImporter::class)
                    ->label('Import Users')
                    ->color('primary'),
            ])->label('Imports Users')
                ->icon('heroicon-o-document-plus')
                ->button(),
        ];
    }
}
