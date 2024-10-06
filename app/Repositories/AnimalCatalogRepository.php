<?php

namespace App\Repositories;

use App\Models\AnimalCatalog;
use Illuminate\Support\Collection;

class AnimalCatalogRepository implements AnimalCatalogRepositoryInterface
{
    /**
     * Select All Animal Catalogs
     *
     * @return mixed
     */
    public function getAll()
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
     * Inser AnimalCatalog
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return AnimalCatalog::create($AnimalData);
    }

    /**
     * Update AnimalCatalog
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data)
    {
        $Animal = AnimalCatalog::find($id);
        if ($Animal) {
            $Animal->update($AnimalData);
            return $Animal;
        }

        return null;
    }

    /**
     * Delete AnimalCatalog Id
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
