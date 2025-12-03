<?php

namespace App\Observers;

use Illuminate\Support\Str;

class SlugObserver
{
    public function creating($model): void
    {
        if (property_exists($model, 'slug') && empty($model->slug) && property_exists($model, 'title')) {
            $model->slug = Str::slug($model->title.'-'.Str::uuid());
        }
    }

    public function updating($model): void
    {
        if (property_exists($model, 'slug') && empty($model->slug) && property_exists($model, 'title')) {
            $model->slug = Str::slug($model->title.'-'.Str::uuid());
        }
    }
}
