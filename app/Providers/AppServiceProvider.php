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
use App\Repositories\ImageRepository;
use App\Repositories\ImageRepositoryInterface;
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

        $this->app->bind(AnimalRepositoryInterface::class, AnimalRepository::class);
        $this->app->bind(AnimalCatalogRepositoryInterface::class, AnimalCatalogRepository::class);

        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(ProductCatalogRepositoryInterface::class, ProductCatalogRepository::class);
        $this->app->bind(ProductPriceRepositoryInterface::class, ProductPriceRepository::class);
        $this->app->bind(ProductOptionRepositoryInterface::class, ProductOptionRepository::class);

        $this->app->bind(FormRequestRepositoryInterface::class, FormRequestRepository::class);
        $this->app->bind(InvoiceRepositoryInterface::class, InvoiceRepository::class);
        $this->app->bind(ImageRepositoryInterface::class, ImageRepository::class);
        $this->app->bind(SponsorRepositoryInterface::class, SponsorRepository::class);
        
        $this->app->bind(StoryRepositoryInterface::class, StoryRepository::class);
        $this->app->bind(StoryCatalogRepositoryInterface::class, StoryCatalogRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}