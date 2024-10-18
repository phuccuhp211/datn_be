<?php

namespace App\Repositories;

use App\Models\Sponsor;

class SponsorRepository implements SponsorRepositoryInterface
{
    public function getAll()
    {
        return Sponsor::all();
    }

    public function getById(int $id)
    {
        return Sponsor::find($id);
    }

    public function insert(array $data)
    {
        return Sponsor::create($data);
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
