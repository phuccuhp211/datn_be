<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface AnimalCatalogRepositoryInterface
{
    /**
     * Select All Animal Catalog
     *
     * @return Collection
     */
    public function getAll();

    /**
     * Select Animal Catalog by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);

    /**
     * Insert Animal Catalog
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Update Animal Catalog
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data);

    /**
     * Delete Animal Catalog by Id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
