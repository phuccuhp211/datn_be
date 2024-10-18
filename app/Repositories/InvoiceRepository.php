<?php

namespace App\Repositories;

use App\Models\Invoice;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function getAll()
    {
        return Invoice::all();
    }

    public function getById(int $id)
    {
        return Invoice::find($id);
    }

    public function create(array $data)
    {
        return Invoice::create($data);
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
