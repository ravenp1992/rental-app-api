<?php

namespace App\Providers;

use Domains\Product\Models\Product;
use Domains\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use TiMacDonald\JsonApi\JsonApiResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::shouldBeStrict(App::isLocal());

        JsonApiResource::resolveIdUsing(fn (Model $model) => $model->uuid);

        Gate::define('update-product', function (User $user, Product $product) {
            return $user->id === $product->user_id;
        });

        Gate::define('publish-product', function (User $user, Product $product) {
            return $user->id === $product->user_id;
        });
    }
}
