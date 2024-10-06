<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface SponsorRepositoryInterface
{
    /**
     * Select All Sponsors
     *
     * @return mixed
     */
    public function getAll();

    /**
     * Select Sponsor by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);

    /**
     * Insert Sponsor
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Update Sponsor
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data);

    /**
     * Delete Sponsor by Id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
