<?php

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function newModel()
    {
        return new Project;
    }

    public function getAll()
    {
        return Project::all();
    }

    public function getById(int $id)
    {
        return Project::find($id);
    }

    public function create(array $data)
    {
        return Project::create($data) ?? false;
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