<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface ProductRepositoryInterface
{
    /**
     * Select All Products
     *
     * @return mixed
     */
    public function getAll();

    /**
     * Select Product by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);

    /**
     * Insert Product
     *
     * @param array $data
     * @return mixed
     */
    public function insert(array $data);

    /**
     * Update Product
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data);

    /**
     * Delete Product by Id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id);
}