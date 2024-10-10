<?php

namespace App\Repositories;

interface FormRequestRepositoryInterface
{
    /**
     * Select All FormRequests
     *
     * @return mixed
     */
    public function getAll();

    /**
     * Select FormRequests by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);

    /**
     * Insert FormRequests
     *
     * @param array $data
     * @return mixed
     */
    public function insert(array $data);

    /**
     * Update FormRequests
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data);

    /**
     * Delete FormRequests by Id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
