<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface AnimalRepositoryInterface
{
    /**
     * Select All Animals
     *
     * @return mixed
     */
    public function getAll();

    /**
     * Select Animal by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);

    /**
     * Insert Animal
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Update Animal
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data);

    /**
     * Delete Animal by Id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}   