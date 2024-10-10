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
     * Select data by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);

    /**
     * Insert data
     *
     * @param array $data
     * @return mixed
     */
    public function insert(array $data);

    /**
     * Update data
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data);

    /**
     * Delete data by Id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
