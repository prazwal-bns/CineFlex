<?php

namespace App\Filament\Resources\MovieResource\Pages\Forms;

use App\Enums\Genre;
use App\Filament\Contracts\ResourceFieldContract;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Grid;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Http;
use App\Models\Country;

final class MovieResourceForm implements ResourceFieldContract
{
    public static function getFields(): array
    {
        return [
            Section::make('Movie Poster')
                ->description('Upload the movie poster image')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            FileUpload::make('poster_url')
                            ->label('Movie Poster Image')
                            ->image()
                            ->disk('public')
                            ->directory('posters')
                            ->imagePreviewHeight('600')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->required()
                            ->imageEditor()
                            ->imageEditorAspectRatios(['2:3'])
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('2:3')
                            ->imageResizeTargetWidth('400')
                            ->imageResizeTargetHeight('600')
                            ->maxSize(5120) // 5MB
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->placeholder('Upload poster image (recommended size: 400x600px)')
                            ->helperText('Upload a high-quality poster image. Supported formats: JPG, PNG, WebP. Max size: 5MB')

                            ->afterStateHydrated(static function (BaseFileUpload $component, string|array|null $state) {
                                if (blank($state)) {
                                    $component->state([]);
                                    return;
                                }

                                // This ensures FileUpload gets the correct state format (uuid => path/url)
                                $component->state([Str::uuid()->toString() => $state]);
                            })

                            // 👇 Controls how the uploaded file's data is stored
                            ->getUploadedFileUsing(static function (BaseFileUpload $component, string $file, string|array|null $storedFileNames): ?array {
                                // Check if the path is an external URL
                                $isExternal = str_starts_with($file, 'http://') || str_starts_with($file, 'https://');

                                return [
                                    'name' => basename($file),
                                    'size' => $isExternal ? null : Storage::disk('public')->size($file),
                                    'type' => $isExternal ? null : Storage::disk('public')->mimeType($file),
                                    'url' => $isExternal ? $file : Storage::disk('public')->url($file),
                                ];
                            })
                    ])
                    ->columnSpan(1)

                ]),

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
                                ->mask('999')
                                ->minValue(1)
                                ->maxValue(300)
                                ->suffix('minutes')
                                ->placeholder('Enter duration in minutes'),

                            DatePicker::make('release_date')
                                ->required()
                                ->native(false)
                                ->displayFormat('d M Y')
                                ->placeholder('Select release date'),
                        ]),
                ]),

            Section::make('Movie Details and Description')
                ->description('Provide few movie details and a detailed description of the movie')
                ->schema([

                    Grid::make(2)
                        ->schema([
                            TextInput::make('director')
                                ->required()
                                ->maxLength(255)
                                ->placeholder('Enter movie director'),

                            Select::make('genre')
                                ->required()
                                ->options([
                                    'action' => 'Action',
                                    'adventure' => 'Adventure',
                                    'animation' => 'Animation',
                                    'comedy' => 'Comedy',
                                    'documentary' => 'Documentary',
                                    'drama' => 'Drama',
                                    'fantasy' => 'Fantasy',
                                    'horror' => 'Horror',
                                    'mystery' => 'Mystery',
                                    'romance' => 'Romance',
                                    'sci-fi' => 'Sci-Fi',
                                    'thriller' => 'Thriller',
                                    'western' => 'Western',
                                    'crime' => 'Crime',
                                ])
                                ->multiple()
                                ->searchable()
                                ->placeholder('Select movie genre'),

                            TextInput::make('language')
                                ->required()
                                ->maxLength(255)
                                ->placeholder('Enter movie language'),

                            Select::make('country')
                                ->required()
                                ->options(Country::pluck('name', 'name'))
                                ->searchable()
                                ->placeholder('Select a country'),
                        ]),

                    RichEditor::make('description')
                        ->required()
                        ->minLength(3)
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
        ];
    }
}
