<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface InvoiceRepositoryInterface
{
    /**
     * Select All Invoices
     *
     * @return mixed
     */
    public function getAll();

    /**
     * Select Invoice by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);

    /**
     * Insert Invoice
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Update Invoice
     *
     * @param int $id
     * @param array $Data
     * @return mixed
     */
    public function update(int $id, array $data);

    /**
     * Delete Invoice by Id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
