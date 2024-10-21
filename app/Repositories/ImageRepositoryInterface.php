<?php

namespace App\Repositories;

interface ImageRepositoryInterface
{
    public function getMany(String $table, int $id);

    public function insertMany(String $table, int $id, array $data);
}