<?php

namespace App\Filament\Resources\MovieResource\Pages\Forms;

use App\Filament\Contracts\ResourceFieldContract;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Grid;

final class MovieResourceForm implements ResourceFieldContract
{
    public static function getFields(): array
    {
        return [
            Section::make('Basic Information')
                ->description('Enter the basic details about the movie')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            TextInput::make('title')
                                ->required()
                                ->maxLength(255)
                                ->placeholder('Enter movie title')
                                ->columnSpan(2),

                            TextInput::make('duration')
                                ->required()
                                ->numeric()
                                ->minValue(1)
                                ->maxValue(300)
                                ->suffix('minutes')
                                ->placeholder('Enter duration in minutes'),

                            DatePicker::make('release_date')
                                ->required()
                                ->displayFormat('d M Y')
                                ->placeholder('Select release date'),
                        ]),
                ]),

            Section::make('Movie Description')
                ->description('Provide a detailed description of the movie')
                ->schema([
                    RichEditor::make('description')
                        ->required()
                        ->minLength(50)
                        ->maxLength(10000)
                        ->toolbarButtons([
                            'bold',
                            'italic',
                            'underline',
                            'strike',
                            'bulletList',
                            'orderedList',
                            'link',
                            'h2',
                            'h3',
                            'blockquote',
                        ])
                        ->placeholder('Enter movie description...'),
                ]),

            Section::make('Movie Poster')
                ->description('Upload the movie poster image')
                ->schema([
                    FileUpload::make('poster_url')
                        ->label('Poster Image')
                        ->image()
                        ->disk('public')
                        ->directory('posters')
                        ->visibility('public')
                        ->preserveFilenames()
                        ->required()
                        ->imageResizeMode('cover')
                        ->imageCropAspectRatio('2:3')
                        ->imageResizeTargetWidth('400')
                        ->imageResizeTargetHeight('600')
                        ->maxSize(5120) // 5MB
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                        ->placeholder('Upload poster image (recommended size: 400x600px)')
                        ->helperText('Upload a high-quality poster image. Supported formats: JPG, PNG, WebP. Max size: 5MB'),
                ]),
        ];
    }
}
