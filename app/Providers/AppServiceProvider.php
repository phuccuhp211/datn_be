<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\AnimalRepository;
use App\Repositories\AnimalRepositoryInterface;
use App\Repositories\AnimalCatalogRepository;
use App\Repositories\AnimalCatalogRepositoryInterface;

use App\Repositories\ProductRepository;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\ProductCatalogRepository;
use App\Repositories\ProductCatalogRepositoryInterface;
use App\Repositories\ProductPriceRepository;
use App\Repositories\ProductPriceRepositoryInterface;
use App\Repositories\ProductOptionRepository;
use App\Repositories\ProductOptionRepositoryInterface;

use App\Repositories\FormRequestRepository;
use App\Repositories\FormRequestRepositoryInterface;
use App\Repositories\InvoiceRepository;
use App\Repositories\InvoiceRepositoryInterface;
use App\Repositories\SponsorRepository;
use App\Repositories\SponsorRepositoryInterface;
use App\Repositories\StoryRepository;
use App\Repositories\StoryRepositoryInterface;
use App\Repositories\StoryCatalogRepository;
use App\Repositories\StoryCatalogRepositoryInterface;

use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

        $this->app->bind(AnimalRepositoryInterface::class, AnimalRepositoryInterface::class);
        $this->app->bind(AnimalCatalogRepository::class, AnimalCatalogRepositoryInterface::class);

        $this->app->bind(ProductRepositoryInterface::class, ProductRepositoryInterface::class);
        $this->app->bind(ProductCatalogRepositoryInterface::class, ProductCatalogRepository::class);
        $this->app->bind(ProductPriceRepositoryInterface::class, ProductPriceRepository::class);
        $this->app->bind(ProductOptionRepositoryInterface::class, ProductOptionRepository::class);

        $this->app->bind(FormRequestRepository::class, FormRequestRepositoryInterface::class);
        $this->app->bind(InvoiceRepository::class, InvoiceRepositoryInterface::class);
        $this->app->bind(SponsorRepository::class, SponsorRepositoryInterface::class);
        
        $this->app->bind(StoryRepository::class, StoryRepositoryInterface::class);
        $this->app->bind(StoryCatalogRepository::class, StoryCatalogRepositoryInterface::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}