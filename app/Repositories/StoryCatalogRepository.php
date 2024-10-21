<?php

namespace App\Repositories;

use App\Models\StoryCatalog;

class StoryCatalogRepository implements StoryCatalogRepositoryInterface
{
    public function getAll(): mixed
    {
        return StoryCatalog::all();
    }

    public function getById(int $id)
    {
        return StoryCatalog::find($id);
    }

    public function create(array $data)
    {
        return StoryCatalog::create($data) ?? false;
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
}
