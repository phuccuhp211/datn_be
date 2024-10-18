<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface ProductSpiceRepositoryInterface
{

    public function getAll();

    public function getById(int $id);

    public function getByProductId(int $id);

    public function insert(array $data);

    public function update(int $id, array $data);

    public function delete(int $id);
}