<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAll()
    {
        return User::all();
    }

    public function getById(int $id)
    {
        return User::find($id);
    }

    public function getByAccount(string $account)
    {
        $target = User::where('account','like', $account)->first();
        return $target ?? false;
    }

    public function getByEmail(string $email)
    {
        $target = User::where('email','like', $email)->first();
        return $target ?? false;
    }

    public function getByPhone(string $phone)
    {
        $target = User::where('phone','like', $phone)->first();
        return $target ?? false;
    }

    public function create(array $userData)
    {
        return User::create($userData);
    }

    public function update(int $id, array $data)
    {
        $target = $this->getById($id);
        return $target ? $target->update($data) : false;
    }

    public function delete(int $id)
    {
        $target = $this->getById($id);
        return $target ? $target->delete() : false;
    }

    public function updateCartForUser(int $id, array $cart)
    {
        $target = $this->getById($id);
        return $target ? $target->update(['cart' => $cart]) : false;
    }
}
