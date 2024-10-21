<?php

namespace App\Repositories;

interface AnimalRepositoryInterface
{
    public function newModel();
    
    public function getAll();

    public function getById(int $id);

    public function create(array $data);

    public function update(int $id, array $data);
    
    public function delete(int $id);
}