<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface StoryRepositoryInterface
{
    /**
     * Select All StoryCatalogs
     *
     * @return mixed
     */
    public function getAll(): mixed;

    /**
     * Select StoryCatalog by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);

    /**
     * Insert StoryCatalog
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Update StoryCatalog
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data);

    /**
     * Delete StoryCatalog by Id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
