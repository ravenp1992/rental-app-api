<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Str;

trait HasSlug
{
    public static function bootHasSlug(): void
    {
        static::creating(function (Model $model): void {
            $model->slug = Str::slug($model->name);
        });
    }
}
