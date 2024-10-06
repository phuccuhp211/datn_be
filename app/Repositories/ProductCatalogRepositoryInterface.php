<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface ProductCatalogRepositoryInterface
{
    /**
     * Select All ProductCatalogs
     *
     * @return mixed
     */
    public function getAll();

    /**
     * Select ProductCatalog by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);

    /**
     * Insert ProductCatalog
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Update ProductCatalog
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data);

    /**
     * Delete ProductCatalog by Id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
