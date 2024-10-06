<?php

namespace App\Repositories;

use App\Models\FormRequest;
use Illuminate\Support\Collection;

class FormRequestwRepository implements FormRequestRepositoryInterface
{
    /**
     * Select All FormRequests
     *
     * @return mixed
     */
    public function getAll()
    {
        return FormRequest::all();
    }

    /**
     * Select FormRequest by Id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return FormRequest::find($id);
    }

    /**
     * Inser FormRequest
     *
     * @param array $data
     * @return mixed
     */
    public function insert(array $data)
    {
        return FormRequest::create($data);
    }

    /**
     * Update FormRequest
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data)
    {
        $FormRequest = FormRequest::find($id);
        if ($FormRequest) {
            $FormRequest->update($data);
            return $FormRequest;
        }

        return null;
    }

    /**
     * Delete FormRequest Id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $FormRequest = FormRequest::find($id);
        if ($FormRequest) {
            return $FormRequest->delete();
        }

        return false;
    }
}
