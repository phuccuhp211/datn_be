<?php

namespace App\Repositories;

use App\Models\Sponsor;
use Illuminate\Support\Collection;

class SponsorRepository implements SponsorRepositoryInterface
{
    /**
     * Select All Sponsors
     *
     * @return Collection
     */
    public function getAll(): Collection
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
     * @param array $SponsorData
     * @return mixed
     */
    public function insert(array $SponsorData)
    {
        return Sponsor::create($SponsorData);
    }

    /**
     * Update Sponsor
     *
     * @param int $id
     * @param array $SponsorData
     * @return mixed
     */
    public function update(int $id, array $SponsorData)
    {
        $Sponsor = Sponsor::find($id);
        if ($Sponsor) {
            $Sponsor->update($SponsorData);
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
