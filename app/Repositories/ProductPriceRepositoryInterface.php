<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface ProductPriceRepositoryInterface
{
    /**
     * Select All ProductPrices
     *
     * @return mixed
     */
    public function getAll();

    /**
     * Select ProductPrice by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);

    /**
     * Select ProductPrice by Product Id
     *
     * @param int $id
     * @return mixed
     */
    public function getByProductId(int $id);

    /**
     * Insert ProductPrice
     *
     * @param array $data
     * @return mixed
     */
    public function insert(array $data);

    /**
     * Update ProductPrice
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data);

    /**
     * Delete ProductPrice by Id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
