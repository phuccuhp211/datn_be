<?php

namespace App\Repositories;

use App\Models\StoryCatalog;
use Illuminate\Support\Collection;

class StoryRepository implements StoryRepositoryInterface
{
    /**
     * Select All StoryCatalogs
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return StoryCatalog::all();
    }

    /**
     * Select StoryCatalog by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return StoryCatalog::find($id);
    }

    /**
     * Inser StoryCatalog
     *
     * @param array $StoryCatalogData
     * @return mixed
     */
    public function insert(array $StoryCatalogData)
    {
        return StoryCatalog::create($StoryCatalogData);
    }

    /**
     * Update StoryCatalog
     *
     * @param int $id
     * @param array $StoryCatalogData
     * @return mixed
     */
    public function update(int $id, array $StoryCatalogData)
    {
        $StoryCatalog = StoryCatalog::find($id);
        if ($StoryCatalog) {
            $StoryCatalog->update($StoryCatalogData);
            return $StoryCatalog;
        }

        return null;
    }

    /**
     * Delete StoryCatalog Id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $StoryCatalog = StoryCatalog::find($id);
        if ($StoryCatalog) {
            return $StoryCatalog->delete();
        }

        return false;
    }
}
