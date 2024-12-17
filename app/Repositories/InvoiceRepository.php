<?php

namespace App\Repositories;

use App\Models\Invoice;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function newModel()
    {
        return new Invoice;
    }

    public function getAll()
    {
        return Invoice::all();
    }

    public function getById(int $id)
    {
        return Invoice::find($id);
    }

    public function getByUserId($userId)
    {
        return Invoice::where('user_id', $userId)->get();
    }

    public function create(array $data)
    {
        return Invoice::create($data) ?? false;
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
