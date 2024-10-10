<?php

namespace App\Repositories;

use App\Models\Animal;
use App\Repositories\AnimalRepositoryInterface;

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
    public function insert(array $data)
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

    /**
     * Filter Animals
     *
     * @param string $action
     * @param string $data
     * @param int $page
     * @param int $limit
     * @param int $filterOne
     * @param int $filterTwo
     * @return mixed
     */
    public function filterAnimals(string $action = null, string $data = null, int $page, int $limit, int $filterOne, array $filterTwo)
    {
        $query = Animal::query();

        $query->where('outOfStock', '=' ,0);

        if ($action == 'search') $query->where('name','like','%'. $data .'%');
        else if ($action == 'catalog') $query->where('type', '=', $data);

        if ($filterOne['fromPrice']) $query->where('','like','%');


    }
}