<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface StoryCatalogRepositoryInterface
{
    public function getAll(): mixed;

    public function getById(int $id);

    public function insert(array $data);

    public function update(int $id, array $data);

    public function delete(int $id);
}
