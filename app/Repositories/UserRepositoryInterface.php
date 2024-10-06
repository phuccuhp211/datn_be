<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    /**
     * Select All Users
     *
     * @return mixed
     */
    public function getAll();

    /**
     * Select User by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);

    /**
     * Insert User
     *
     * @param array $userData
     * @return mixed
     */
    public function create(array $userData);

    /**
     * Update User
     *
     * @param int $id
     * @param array $userData
     * @return mixed
     */
    public function update(int $id, array $userData);

    /**
     * Delete User by Id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
