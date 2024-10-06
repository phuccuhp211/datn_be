<?php

namespace App\Repositories;

use App\Models\Invoice;
use Illuminate\Support\Collection;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    /**
     * Select All Invoices
     *
     * @return Collection
     */
    public function getAll(): Collection
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
     * @param array $InvoiceData
     * @return mixed
     */
    public function insert(array $InvoiceData)
    {
        return Invoice::create($InvoiceData);
    }

    /**
     * Update Invoice
     *
     * @param int $id
     * @param array $InvoiceData
     * @return mixed
     */
    public function update(int $id, array $InvoiceData)
    {
        $Invoice = Invoice::find($id);
        if ($Invoice) {
            $Invoice->update($InvoiceData);
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
