<?php

namespace App\Http\Controllers;

use App\Http\Resources\DeletedItemResource;
use App\Repositories\Repositories\DeletedItemRepository;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DeletedItemController extends Controller
{
    public function getDeletedItems(): ResourceCollection
    {
        $deletedItems = DeletedItemRepository::getDeletedItems();

        return DeletedItemResource::collection($deletedItems);
    }
}
