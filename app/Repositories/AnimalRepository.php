<?php

namespace App\Repositories;

use App\Models\Animal;

class AnimalRepository implements AnimalRepositoryInterface
{
    public function getAll()
    {
        return Animal::all();
    }

    public function getById($id)
    {
        return Animal::findOrFail($id);
    }

    public function create(array $data)
    {
        return Animal::create($data);
    }

    public function update($id, array $data)
    {
        $animal = $this->getById($id);
        $animal->update($data);
        return $animal;
    }

    public function delete($id)
    {
        $animal = $this->getById($id);
        $animal->delete();
        return $animal;
    }
}