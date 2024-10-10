<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface StoryRepositoryInterface
{
    /**
     * Select All Stories
     *
     * @return mixed
     */
    public function getAll();

    /**
     * Select Story by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);

    /**
     * Insert Story
     *
     * @param array $data
     * @return mixed
     */
    public function insert(array $data);

    /**
     * Update Story
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data);

    /**
     * Delete Story by Id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
