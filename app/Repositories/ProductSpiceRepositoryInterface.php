<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface ProductSpiceRepositoryInterface
{
    /**
     * Select All ProductSpices
     *
     * @return mixed
     */
    public function getAll();

    /**
     * Select ProductSpice by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);

    /**
     * Insert ProductSpice
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Update ProductSpice
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data);

    /**
     * Delete ProductSpice by Id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
