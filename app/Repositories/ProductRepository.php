<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\ProductPriceRepositoryInterface;
use App\Repositories\ProductSpiceRepositoryInterface;
use Illuminate\Support\Collection;
use Symfony\Component\Translation\Extractor\Visitor\TransMethodVisitor;

class ProductRepository implements ProductRepositoryInterface
{
    protected $productSpiceRepository;
    protected $productPriceRepository;

    public function __construct(
        ProductSpiceRepositoryInterface $productSpiceRepository, 
        ProductPriceRepositoryInterface $productPriceRepository
    )
    {
        $this->productSpiceRepository = $productSpiceRepository;
        $this->productPriceRepository = $productPriceRepository;
    }

    /**
     * Select All Products
     *
     * @return mixed
     */
    public function getAll()
    {
        return Product::all();
    }

    /**
     * Select Product by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        $product = Product::find($id);
        $size = $this->productPriceRepository->getByProductId($id);
        $spice = $this->productSpiceRepository->getByProductId($id);

        $product->size = $size->toArray();
        if ($spice) $product->spice = $spice->toArray();

        return $product;
    }

    /**
     * Inser Product
     *
     * @param array $data
     * @return mixed
     */
    public function insert(array $data)
    {
        return Product::create($data);
    }

    /**
     * Update Product
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data)
    {
        $Product = Product::find($id);
        if ($Product) {
            $Product->update($data);
            return $Product;
        }

        return null;
    }

    /**
     * Delete Product Id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $Product = Product::find($id);
        if ($Product) {
            return $Product->delete();
        }

        return false;
    }

    /**
     * Filter Product
     *
     * @param string $action
     * @param string $data
     * @param int $order
     * @param string $page
     * @param int $limit
     * @return mixed
     */
    public function filter(string $action, string $data, int $order, int $page, int $limit)
    {   
        $query = Product::query();
        $query->where('out_of_stock', '=', 0);

        if ($action == 'catalog') $query->where('type','=', $data);
        else if ($action == 'search') $query->where('name', 'like', '%'.$data.'%');
            
        if ($order) {
            if ($order == 1) $query->orderBy('id', 'ASC');
            else if ($order == 2) $query->orderBy('id', 'DESC');
            else if ($order == 3) $query->orderBy('name','ASC');
            else if ($order == 4) $query->orderBy('name','DESC');
            else if ($order == 3) $query->orderBy('price','ASC');
            else if ($order == 4) $query->orderBy('price','DESC');
        }
            
        return $query->offset(($page*$limit)-$limit)->limit($limit)->get();
    }
}
