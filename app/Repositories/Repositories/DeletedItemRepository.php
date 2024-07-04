<?php

namespace App\Repositories\Repositories;

use App\Models\DeletedItem;
use Illuminate\Support\Collection;

class DeletedItemRepository
{
    public static function getDeletedItems(): Collection
    {
        return DeletedItem::all()->sortByDesc('times_deleted');
    }
}
