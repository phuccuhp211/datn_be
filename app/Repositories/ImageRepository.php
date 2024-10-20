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
            $oldRecord = Image::select('id')->where(["table", $table,"id_refence", $id])->get();
            Image::destroy($oldRecord);
            Image::insert($data);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}