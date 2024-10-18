<?php

namespace App\Repositories;

use App\Models\Story;
use Illuminate\Support\Collection;

class StoryRepository implements StoryRepositoryInterface
{
    public function getAll()
    {
        return Story::all();
    }

    public function getById(int $id)
    {
        return Story::find($id);
    }

    public function insert(array $StoryData)
    {
        return Story::create($StoryData);
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
