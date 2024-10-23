<?php

namespace App\Repositories;

use App\Models\AnimalCatalog;

class AnimalCatalogRepository implements AnimalCatalogRepositoryInterface
{
    public function newModel()
    {
        return new AnimalCatalog;
    }

    public function getAll()
    {
        return AnimalCatalog::with('images')->get();
    }

    public function getById($id)
    {
        return AnimalCatalog::with('images')->findOrFail($id);
    }

    public function create(array $data)
    {
        return AnimalCatalog::create($data) ?? false;
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
