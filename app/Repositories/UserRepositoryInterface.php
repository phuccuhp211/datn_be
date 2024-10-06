<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    /**
     * Select All Users
     *
     * @return Collection
     */
    public function getAllUsers(): Collection;

    /**
     * Select User by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getUserById(int $id);

    /**
     * Insert User
     *
     * @param array $userData
     * @return mixed
     */
    public function createUser(array $userData);

    /**
     * Update User
     *
     * @param int $id
     * @param array $userData
     * @return mixed
     */
    public function updateUser(int $id, array $userData);

    /**
     * Delete User by Id
     *
     * @param int $id
     * @return bool
     */
    public function deleteUser(int $id): bool;
}
