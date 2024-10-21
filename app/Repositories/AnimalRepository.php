<?php

namespace App\Repositories;

use App\Models\Animal;

class AnimalRepository implements AnimalRepositoryInterface
{
    public function getAll()
    {
        return Animal::all();
    }

    public function getById(int $id)
    {
        return Animal::find($id);
    }

    public function create(array $data)
    {
        return Animal::create($data) ?? false;
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