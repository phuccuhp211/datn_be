<?php

namespace App\Repositories;

interface AnimalRepositoryInterface
{
    /**
     * Select All Animals
     *
     * @return mixed
     */
    public function getAll();

    /**
     * Select Animal by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);

    /**
     * Insert Animal
     *
     * @param array $data
     * @return mixed
     */
    public function insert(array $data);

    /**
     * Update Animal
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data);

    /**
     * Delete Animal by Id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id);

    /**
     * Filter Animals
     *
     * @param string $action
     * @param string $data
     * @param int $page
     * @param int $limit
     * @param int $filterOne
     * @param int $filterTwo
     * @return mixed
     */
    public function filterAnimals(string $action, string $data, int $page, int $limit, int $filterOne, array $filterTwo);
}   