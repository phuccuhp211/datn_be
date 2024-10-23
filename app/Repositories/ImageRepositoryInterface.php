<?php

namespace App\Repositories;

interface ImageRepositoryInterface
{
    public function getMany(String $table, int $id);

    public function insertMany(String $table, int $id, array $data);

    public function create(array $data);
    
    public function delete($id);
}