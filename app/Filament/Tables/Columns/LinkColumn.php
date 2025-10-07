<?php

namespace App\Filament\Tables\Columns;

use Closure;
use Filament\Tables\Columns\TextColumn;
use Filament\Support\Enums\TextSize;
use Illuminate\Database\Eloquent\Model;

class LinkColumn extends TextColumn
{
    protected string $view = 'filament.tables.columns.link-column';

    public ?string $clonedUrl = null;

    public string $target = '_blank';

    protected TextSize|string|Closure|null $size = 'xs';

    public function target(string $target): static
    {
        $this->target = $target;

        return $this;
    }

    public function getTarget(): string
    {
        return $this->target;
    }

    public function getClonedUrl(): ?string
    {
        $this->clonedUrl = $this->evaluate($this->url);

        return $this->clonedUrl;
    }

    public function getExtraCellAttributes(): array
    {
        return ['class' => '[&_.fi-ta-col-wrp]:flex [&_.fi-ta-col-wrp>a:first-child]:absolute [&_.fi-ta-col-wrp>a:first-child]:inset-0 relative'];
    }

    /**
     * Here in this method we replace the URL of column with table recordURL
     * By default the column apply it URL on whole cell, and we replace it with recordURL now it apply record url to whole cell
     * But we apply url on text of column explicitly on blade file.
     */
    public function getUrl($record = null): ?string
    {
        /**
         * @var Model $model
         */
        $model = $record ?? $this->getRecord();

        return $this->getTable()->getRecordUrl($model);
    }
}
