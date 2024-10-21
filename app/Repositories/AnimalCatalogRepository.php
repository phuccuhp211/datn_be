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
        return AnimalCatalog::all();
    }

    public function getById(int $id)
    {
        return AnimalCatalog::find($id);
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