<?php

namespace App\Repositories;

use App\Models\Story;

class StoryRepository implements StoryRepositoryInterface
{
    public function newModel()
    {
        return new Story;
    }

    public function getAll()
    {
        return Story::all();
    }

    public function getById(int $id)
    {
        return Story::find($id);
    }

    public function create(array $data)
    {
        return Story::create($data) ?? false;
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
