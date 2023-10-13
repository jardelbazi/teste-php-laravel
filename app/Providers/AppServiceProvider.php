<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Services
        $this->app->bind(
            \App\Services\Category\CategoryServiceInterface::class,
            \App\Services\Category\CategoryService::class
        );
        $this->app->bind(
            \App\Services\Document\DocumentServiceInterface::class,
            \App\Services\Document\DocumentService::class
        );

        //Repositories
        $this->app->bind(
            \App\Repositories\Category\CategoryRepositoryInterface::class,
            \App\Repositories\Category\CategoryRepository::class
        );
        $this->app->bind(
            \App\Repositories\Document\DocumentRepositoryInterface::class,
            \App\Repositories\Document\DocumentRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
