<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\AnimalRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;

class BasicController extends Controller
{
    protected $animalRepository;
    protected $productRepository;

    public function __construct
    (
        AnimalRepositoryInterface $animalRepository,
        ProductRepositoryInterface $productRepository
    )
    {
        $this->animalRepository = $animalRepository;
        $this->productRepository = $productRepository;
    }
}
