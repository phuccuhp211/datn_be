<?php

namespace App\Repositories;

use App\Models\Story;
use Illuminate\Support\Collection;

class StoryRepository implements StoryRepositoryInterface
{
    /**
     * Select All Storys
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Story::all();
    }

    /**
     * Select Story by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return Story::find($id);
    }

    /**
     * Inser Story
     *
     * @param array $StoryData
     * @return mixed
     */
    public function insert(array $StoryData)
    {
        return Story::create($StoryData);
    }

    /**
     * Update Story
     *
     * @param int $id
     * @param array $StoryData
     * @return mixed
     */
    public function update(int $id, array $StoryData)
    {
        $Story = Story::find($id);
        if ($Story) {
            $Story->update($StoryData);
            return $Story;
        }

        return null;
    }

    /**
     * Delete Story Id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $Story = Story::find($id);
        if ($Story) {
            return $Story->delete();
        }

        return false;
    }
}
