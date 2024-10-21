<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function newModel();
    
    public function getAll();

    public function getById(int $id);

    public function getByAccount(string $account);

    public function getByEmail(string $email);

    public function getByPhone(string $phone);

    public function create(array $userData);

    public function update(int $id, array $userData);

    public function delete(int $id);

    public function updateCartForUser(int $id, array $cart);
}
