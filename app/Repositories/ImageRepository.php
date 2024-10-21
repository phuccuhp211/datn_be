<?php

namespace App\Repositories;

use Exception;
use App\Models\Image;

class ImageRepository implements ImageRepositoryInterface
{
    public function getMany(string $table, int $id)
    {
        return Image::where(["table", $table,"id_refence", $id])->get();
    }

    public function insertMany(string $table, int $id, array $data)
    {
        try {
            $oldRecord = Image::where(["table" => $table, "id_reference" => $id])->pluck('id')->toArray();
            if (Image::destroy($oldRecord) && Image::insert($data)) return true;
            else return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}