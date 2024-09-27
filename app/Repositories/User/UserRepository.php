<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Select All Users
     *
     * @return Collection
     */
    public function getAllUsers(): Collection
    {
        return User::all();
    }

    /**
     * Select User by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getUserById(int $id)
    {
        return User::find($id);
    }

    /**
     * Inser User
     *
     * @param array $userData
     * @return mixed
     */
    public function insert(array $userData)
    {
        return User::create($userData);
    }

    /**
     * Update User
     *
     * @param int $id
     * @param array $userData
     * @return mixed
     */
    public function update(int $id, array $userData)
    {
        $user = User::find($id);
        if ($user) {
            $user->update($userData);
            return $user;
        }

        return null;
    }

    /**
     * Delete User Id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $user = User::find($id);
        if ($user) {
            return $user->delete();
        }

        return false;
    }
}
