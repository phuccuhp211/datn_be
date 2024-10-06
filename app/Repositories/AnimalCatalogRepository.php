<?php

namespace App\Repositories;

use App\Models\AnimalCatalog;
use Illuminate\Support\Collection;

class AnimalCatalogRepository implements AnimalCatalogRepositoryInterface
{
    /**
     * Select All AnimalCatalog
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return AnimalCatalog::all();
    }

    /**
     * Select AnimalCatalog by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return AnimalCatalog::find($id);
    }

    /**
     * Inser Animal
     *
     * @param array $AnimalData
     * @return mixed
     */
    public function insert(array $AnimalData)
    {
        return AnimalCatalog::create($AnimalData);
    }

    /**
     * Update Animal
     *
     * @param int $id
     * @param array $AnimalData
     * @return mixed
     */
    public function update(int $id, array $AnimalData)
    {
        $Animal = AnimalCatalog::find($id);
        if ($Animal) {
            $Animal->update($AnimalData);
            return $Animal;
        }

        return null;
    }

    /**
     * Delete Animal Id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $Animal = AnimalCatalog::find($id);
        if ($Animal) {
            return $Animal->delete();
        }

        return false;
    }
}
