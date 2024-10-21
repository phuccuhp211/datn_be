<?php

namespace App\Repositories;

use App\Models\Sponsor;

class SponsorRepository implements SponsorRepositoryInterface
{
    public function newModel()
    {
        return new Sponsor;
    }

    public function getAll()
    {
        return Sponsor::all();
    }

    public function getById(int $id)
    {
        return Sponsor::find($id);
    }

    public function create(array $data)
    {
        return Sponsor::create($data) ?? false;
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
