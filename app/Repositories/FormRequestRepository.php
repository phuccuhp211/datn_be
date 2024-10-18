<?php

namespace App\Repositories;

use App\Models\FormRequest;

class FormRequestRepository implements FormRequestRepositoryInterface
{
    public function getAll()
    {
        return FormRequest::all();
    }

    public function getById(int $id)
    {
        return FormRequest::find($id);
    }

    public function create(array $data)
    {
        return FormRequest::create($data);
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
