<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function getAll();

    public function getById(int $id);

    public function insert(array $userData);

    public function update(int $id, array $userData);

    public function delete(int $id);
}
