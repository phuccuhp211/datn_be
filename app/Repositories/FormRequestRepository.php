<?php

namespace App\Repositories;

use App\Models\FormRequest;
use Illuminate\Support\Collection;

class FormRequestwRepository implements FormRequestRepositoryInterface
{
    /**
     * Select All FormRequests
     *
     * @return Collection
     */
    public function getAll(): Collection
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
     * @param array $FormRequestData
     * @return mixed
     */
    public function insert(array $FormRequestData)
    {
        return FormRequest::create($FormRequestData);
    }

    /**
     * Update FormRequest
     *
     * @param int $id
     * @param array $FormRequestData
     * @return mixed
     */
    public function update(int $id, array $FormRequestData)
    {
        $FormRequest = FormRequest::find($id);
        if ($FormRequest) {
            $FormRequest->update($FormRequestData);
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
