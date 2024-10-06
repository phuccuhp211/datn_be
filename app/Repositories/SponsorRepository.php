<?php

namespace App\Repositories;

use App\Models\Sponsor;
use Illuminate\Support\Collection;

class SponsorRepository implements SponsorRepositoryInterface
{
    /**
     * Select All Sponsors
     *
     * @return mixed
     */
    public function getAll()
    {
        return Sponsor::all();
    }

    /**
     * Select Sponsor by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return Sponsor::find($id);
    }

    /**
     * Inser Sponsor
     *
     * @param array $data
     * @return mixed
     */
    public function insert(array $data)
    {
        return Sponsor::create($data);
    }

    /**
     * Update Sponsor
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data)
    {
        $Sponsor = Sponsor::find($id);
        if ($Sponsor) {
            $Sponsor->update($data);
            return $Sponsor;
        }

        return null;
    }

    /**
     * Delete Sponsor Id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $Sponsor = Sponsor::find($id);
        if ($Sponsor) {
            return $Sponsor->delete();
        }

        return false;
    }
}
