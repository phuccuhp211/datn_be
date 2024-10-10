<?php

namespace App\Repositories;

use App\Models\StoryCatalog;
use Illuminate\Support\Collection;

class StoryCatalogRepository implements StoryCatalogRepositoryInterface
{
    /**
     * Select All StoryCatalogs
     *
     * @return mixed
     */
    public function getAll(): mixed
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
     * @param array $data
     * @return mixed
     */
    public function insert(array $data)
    {
        return StoryCatalog::create($data);
    }

    /**
     * Update StoryCatalog
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data)
    {
        $StoryCatalog = StoryCatalog::find($id);
        if ($StoryCatalog) {
            $StoryCatalog->update($data);
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
