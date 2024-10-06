<?php

namespace App\Repositories;

use App\Models\Invoice;
use Illuminate\Support\Collection;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    /**
     * Select All Invoices
     *
     * @return mixed
     */
    public function getAll()
    {
        return Invoice::all();
    }

    /**
     * Select Invoice by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return Invoice::find($id);
    }

    /**
     * Inser Invoice
     *
     * @param array $data
     * @return mixed
     */
    public function insert(array $data)
    {
        return Invoice::create($data);
    }

    /**
     * Update Invoice
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data)
    {
        $Invoice = Invoice::find($id);
        if ($Invoice) {
            $Invoice->update($data);
            return $Invoice;
        }

        return null;
    }

    /**
     * Delete Invoice Id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $Invoice = Invoice::find($id);
        if ($Invoice) {
            return $Invoice->delete();
        }

        return false;
    }
}
