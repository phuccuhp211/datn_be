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
    public function filter(string $action, string $data = null, int $order = 1, int $page = 1, int $limit = 4);
}