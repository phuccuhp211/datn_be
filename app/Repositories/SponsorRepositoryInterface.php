<?php

namespace App\Repositories;

interface SponsorRepositoryInterface
{
    public function getAll();

    public function getById(int $id);

    public function insert(array $data);

    public function update(int $id, array $data);

    public function delete(int $id);
}
