<?php

namespace App\Repositories;

use App\Models\Animal;
use Illuminate\Support\Collection;

class AnimalRepository implements AnimalRepositoryInterface
{
    /**
     * Select All Animals
     *
     * @return mixed
     */
    public function getAll()
    {
        return Animal::all();
    }

    /**
     * Select Animals by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return Animal::find($id);
    }

    /**
     * Inser Animal
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return Animal::create($data);
    }

    /**
     * Update Animal
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data)
    {
        $animal = $this->getById($id);
        $animal->update($data);
        return $animal;
    }

    /**
     * Delete Animal Id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        $animal = Animal::find($id);
        if ($animal) {
            return $animal->delete();
        }

        return false;
    }
}